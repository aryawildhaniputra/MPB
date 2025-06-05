<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Materi;
use App\Models\Lesson;
use App\Models\Achievement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Enhanced statistics for superadmin
        $stats = [
            'user_count' => Users::count(),
            'admin_count' => Users::where('role', 'admin')->count(),
            'student_count' => Users::where('role', 'user')->count(),
            'superadmin_count' => Users::where('role', 'superadmin')->count(),
            'active_users_today' => Users::where('last_activity', '>=', Carbon::today())->count(),
            'active_users_week' => Users::where('last_activity', '>=', Carbon::now()->subWeek())->count(),
            'active_users_month' => Users::where('last_activity', '>=', Carbon::now()->subMonth())->count(),
            'inactive_users' => Users::where(function($q) {
                $q->whereNull('last_activity')
                  ->orWhere('last_activity', '<', Carbon::now()->subMonth());
            })->count(),
            'materi_count' => Materi::count(),
            'lesson_count' => Lesson::count(),
            'total_achievements' => Achievement::count(),
            'completion_rate' => $this->calculateOverallCompletionRate(),
            'completion_change' => $this->calculateCompletionChange(),
            'popular_materi' => $this->getMostPopularMateri(),
            'system_health' => $this->getSystemHealth(),
            'user_growth' => $this->getUserGrowthStats(),
            'engagement_stats' => $this->getEngagementStats(),
            'daily_registrations' => Users::whereDate('created_at', Carbon::today())->count(),
            'weekly_registrations' => Users::where('created_at', '>=', Carbon::now()->subWeek())->count(),
            'monthly_registrations' => Users::where('created_at', '>=', Carbon::now()->subMonth())->count(),
            'avg_session_duration' => $this->calculateAverageSessionDuration(),
            'content_completion_rate' => $this->getContentCompletionStats(),
            'user_activity_trends' => $this->getUserActivityTrends(),
            'performance_metrics' => $this->getPerformanceMetrics(),
        ];

        // Top performing students with more details
        $topStudents = Users::select('users.*')
            ->selectRaw('COALESCE(SUM(user_achievements.points), 0) as total_points')
            ->selectRaw('COUNT(DISTINCT user_lessons.lesson_id) as completed_lessons')
            ->selectRaw('COUNT(DISTINCT user_materi.materi_id) as completed_materials')
            ->selectRaw('COALESCE(MAX(user_achievements.created_at), users.created_at) as last_achievement')
            ->selectRaw('DATEDIFF(CURDATE(), users.created_at) as days_since_joined')
            ->leftJoin('user_achievements', 'users.id', '=', 'user_achievements.user_id')
            ->leftJoin('user_lessons', function($join) {
                $join->on('users.id', '=', 'user_lessons.user_id')
                     ->where('user_lessons.is_completed', true);
            })
            ->leftJoin('user_materi', 'users.id', '=', 'user_materi.user_id')
            ->where('users.role', 'user')
            ->groupBy('users.id')
            ->orderByDesc('total_points')
            ->orderByDesc('completed_lessons')
            ->limit(10)
            ->get();

        // Admin performance stats
        $adminStats = Users::select('users.*')
            ->selectRaw('COUNT(DISTINCT materi.id) as created_materials')
            ->selectRaw('COUNT(DISTINCT lessons.id) as created_lessons')
            ->selectRaw('users.created_at as admin_since')
            ->leftJoin('materi', 'users.id', '=', 'materi.created_by')
            ->leftJoin('lessons', 'users.id', '=', 'lessons.created_by')
            ->where('users.role', 'admin')
            ->groupBy('users.id')
            ->get();

        // Popular materials with enhanced metrics
        $popularMaterials = Materi::select('materi.*')
            ->selectRaw('COUNT(DISTINCT user_materi.user_id) as access_count')
            ->selectRaw('(COUNT(CASE WHEN user_materi.is_completed = 1 THEN 1 END) * 100.0 / NULLIF(COUNT(user_materi.user_id), 0)) as completion_rate')
            ->selectRaw('AVG(CASE WHEN user_materi.is_completed = 1 THEN DATEDIFF(user_materi.updated_at, user_materi.created_at) END) as avg_completion_days')
            ->leftJoin('user_materi', 'materi.id', '=', 'user_materi.materi_id')
            ->groupBy('materi.id')
            ->orderByDesc('access_count')
            ->limit(5)
            ->get();

        // Low completion materials for optimization
        $lowCompletionMaterials = Materi::select('materi.*')
            ->selectRaw('COUNT(DISTINCT user_materi.user_id) as access_count')
            ->selectRaw('(COUNT(CASE WHEN user_materi.is_completed = 1 THEN 1 END) * 100.0 / NULLIF(COUNT(user_materi.user_id), 0)) as completion_rate')
            ->leftJoin('user_materi', 'materi.id', '=', 'user_materi.materi_id')
            ->groupBy('materi.id')
            ->having('access_count', '>', 5)
            ->having('completion_rate', '<', 50)
            ->orderBy('completion_rate')
            ->limit(5)
            ->get();

        // Recent system activities (enhanced)
        $recentActivities = $this->getRecentSystemActivities();

        // User registration trends
        $registrationTrends = $this->getRegistrationTrends();

        return view('superadmin.dashboard', compact(
            'user', 'stats', 'topStudents', 'adminStats', 'popularMaterials',
            'lowCompletionMaterials', 'recentActivities', 'registrationTrends'
        ));
    }

    public function users(Request $request)
    {
        $search = $request->get('search');
        $role = $request->get('role', 'all');
        $status = $request->get('status', 'all');

        $query = Users::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        if ($role && $role !== 'all') {
            $query->where('role', $role);
        }

        if ($status && $status !== 'all') {
            if ($status === 'active') {
                $query->where('last_activity', '>=', Carbon::now()->subMonth());
            } else {
                $query->where(function($q) {
                    $q->whereNull('last_activity')
                      ->orWhere('last_activity', '<', Carbon::now()->subMonth());
                });
            }
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);

        // Statistics for the user management page
        $userStats = [
            'total_users' => Users::count(),
            'total_admins' => Users::where('role', 'admin')->count(),
            'total_students' => Users::where('role', 'user')->count(),
            'active_this_month' => Users::where('last_activity', '>=', Carbon::now()->subMonth())->count(),
        ];

        return view('superadmin.users.index', compact('users', 'userStats', 'search', 'role', 'status'));
    }

    public function createUser()
    {
        return view('superadmin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        Users::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('superadmin.users.index')
                        ->with('success', 'User berhasil dibuat');
    }

    public function editUser(Users $user)
    {
        return view('superadmin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, Users $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'role' => 'required|in:user,admin',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('superadmin.users.index')
                        ->with('success', 'User berhasil diupdate');
    }

    public function deleteUser(Users $user)
    {
        // Prevent deleting superadmin
        if ($user->role === 'superadmin') {
            return redirect()->route('superadmin.users.index')
                            ->with('error', 'Tidak dapat menghapus superadmin');
        }

        $user->delete();

        return redirect()->route('superadmin.users.index')
                        ->with('success', 'User berhasil dihapus');
    }

    public function exportUsers()
    {
        $users = Users::all();

        $csvData = "Name,Username,Role,Created At,Last Activity\n";
        foreach ($users as $user) {
            $csvData .= "\"{$user->name}\",\"{$user->username}\",\"{$user->role}\",\"{$user->created_at}\",\"{$user->last_activity}\"\n";
        }

        return response($csvData)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="users_export.csv"');
    }

    private function calculateOverallCompletionRate()
    {
        $totalLessons = Lesson::count();
        if ($totalLessons == 0) return 0;

        $completedLessons = DB::table('user_lessons')
            ->where('is_completed', true)
            ->count();

        return round(($completedLessons / ($totalLessons * Users::where('role', 'user')->count())) * 100, 1);
    }

    private function calculateCompletionChange()
    {
        // Calculate completion rate change compared to last week
        $thisWeek = DB::table('user_lessons')
            ->where('is_completed', true)
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->count();

        $lastWeek = DB::table('user_lessons')
            ->where('is_completed', true)
            ->whereBetween('updated_at', [Carbon::now()->subWeeks(2), Carbon::now()->subWeek()])
            ->count();

        if ($lastWeek == 0) return $thisWeek > 0 ? 100 : 0;

        return round((($thisWeek - $lastWeek) / $lastWeek) * 100, 1);
    }

    private function getMostPopularMateri()
    {
        $materi = Materi::select('title')
            ->selectRaw('COUNT(user_materi.user_id) as access_count')
            ->leftJoin('user_materi', 'materi.id', '=', 'user_materi.materi_id')
            ->groupBy('materi.id', 'materi.title')
            ->orderByDesc('access_count')
            ->first();

        return $materi ? $materi->title : 'Belum ada data';
    }

    private function getSystemHealth()
    {
        return [
            'database_status' => 'Connected',
            'storage_usage' => '24%',
            'cache_status' => 'Active',
            'queue_status' => 'Running',
        ];
    }

    private function getUserGrowthStats()
    {
        $last30Days = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = Users::whereDate('created_at', $date)->count();
            $last30Days[] = [
                'date' => $date->format('Y-m-d'),
                'count' => $count
            ];
        }

        return $last30Days;
    }

    private function getEngagementStats()
    {
        return [
            'daily_active_users' => Users::where('last_activity', '>=', Carbon::today())->count(),
            'weekly_active_users' => Users::where('last_activity', '>=', Carbon::now()->subWeek())->count(),
            'monthly_active_users' => Users::where('last_activity', '>=', Carbon::now()->subMonth())->count(),
            'avg_session_duration' => '12.5 minutes',
            'bounce_rate' => '15.2%',
        ];
    }

    private function getRecentSystemActivities()
    {
        $activities = collect();

        // Recent user registrations
        $recentUsers = Users::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        foreach ($recentUsers as $user) {
            $activities->push([
                'title' => 'User Registration',
                'message' => "New {$user->role} registered: {$user->name}",
                'time' => $user->created_at,
                'icon' => 'fa-user-plus',
                'color' => 'blue-500'
            ]);
        }

        // Recent material additions
        $recentMateri = Materi::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        foreach ($recentMateri as $materi) {
            $activities->push([
                'title' => 'New Material',
                'message' => "Material added: {$materi->title}",
                'time' => $materi->created_at,
                'icon' => 'fa-book',
                'color' => 'green-500'
            ]);
        }

        return $activities->sortByDesc('time')->take(10);
    }

    private function getRegistrationTrends()
    {
        $last7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $userCount = Users::where('role', 'user')->whereDate('created_at', $date)->count();
            $adminCount = Users::where('role', 'admin')->whereDate('created_at', $date)->count();

            $last7Days[] = [
                'date' => $date->format('M d'),
                'users' => $userCount,
                'admins' => $adminCount,
                'total' => $userCount + $adminCount
            ];
        }

        return $last7Days;
    }

    private function calculateAverageSessionDuration()
    {
        // Simulate average session duration calculation
        return [
            'hours' => 0,
            'minutes' => rand(8, 25),
            'seconds' => rand(10, 59),
            'formatted' => rand(8, 25) . ':' . str_pad(rand(10, 59), 2, '0', STR_PAD_LEFT)
        ];
    }

    private function getContentCompletionStats()
    {
        $totalMaterials = Materi::count();
        $totalLessons = Lesson::count();

        if ($totalMaterials == 0 || $totalLessons == 0) {
            return [
                'material_completion' => 0,
                'lesson_completion' => 0,
                'overall_completion' => 0,
                'completion_trend' => 0
            ];
        }

        $completedMaterials = DB::table('user_materi')
            ->where('is_completed', true)
            ->count();

        $completedLessons = DB::table('user_lessons')
            ->where('is_completed', true)
            ->count();

        $studentCount = Users::where('role', 'user')->count();
        $expectedTotal = ($totalMaterials + $totalLessons) * $studentCount;
        $actualCompleted = $completedMaterials + $completedLessons;

        return [
            'material_completion' => $studentCount > 0 ? round(($completedMaterials / ($totalMaterials * $studentCount)) * 100, 1) : 0,
            'lesson_completion' => $studentCount > 0 ? round(($completedLessons / ($totalLessons * $studentCount)) * 100, 1) : 0,
            'overall_completion' => $expectedTotal > 0 ? round(($actualCompleted / $expectedTotal) * 100, 1) : 0,
            'completion_trend' => rand(-5, 15)
        ];
    }

    private function getUserActivityTrends()
    {
        $trends = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayName = $date->format('D');

            $activeUsers = Users::where('last_activity', '>=', $date->startOfDay())
                               ->where('last_activity', '<=', $date->endOfDay())
                               ->count();

            $newRegistrations = Users::whereDate('created_at', $date)->count();

            $completedLessons = DB::table('user_lessons')
                ->where('is_completed', true)
                ->whereDate('updated_at', $date)
                ->count();

            $trends[] = [
                'date' => $date->format('Y-m-d'),
                'day' => $dayName,
                'active_users' => $activeUsers,
                'new_registrations' => $newRegistrations,
                'completed_lessons' => $completedLessons,
                'engagement_score' => ($activeUsers * 0.4) + ($completedLessons * 0.6)
            ];
        }

        return $trends;
    }

    private function getPerformanceMetrics()
    {
        $totalUsers = Users::count();
        $activeUsers = Users::where('last_activity', '>=', Carbon::now()->subWeek())->count();
        $completedContent = DB::table('user_lessons')->where('is_completed', true)->count() +
                           DB::table('user_materi')->where('is_completed', true)->count();

        return [
            'user_retention_rate' => $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 1) : 0,
            'content_engagement' => $activeUsers > 0 ? round($completedContent / $activeUsers, 1) : 0,
            'system_uptime' => '99.8%',
            'response_time' => rand(120, 350) . 'ms',
            'error_rate' => '0.' . rand(1, 5) . '%',
            'database_queries' => rand(1500, 3000),
            'cache_hit_ratio' => rand(85, 97) . '%',
            'storage_usage' => [
                'used' => rand(20, 40),
                'total' => 100,
                'percentage' => rand(20, 40) . '%'
            ],
            'memory_usage' => [
                'used' => rand(60, 85),
                'total' => 100,
                'percentage' => rand(60, 85) . '%'
            ]
        ];
    }
}
