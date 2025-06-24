<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Materi;
use App\Models\Lesson;
use App\Models\Achievement;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\AchievementService;

/**
 * DashboardController manages dashboard views for both regular users and admins.
 *
 * IMPORTANT NOTE FOR POSTGRESQL:
 * When writing SQL queries that involve boolean comparisons, always use true/false instead of 1/0.
 * PostgreSQL requires boolean values as `true` or `false` (e.g., where('completed', true)).
 * Using integers like `1` or `0` will cause type mismatch errors.
 */
class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $role = $user->role;

        // Check and update user achievements
        $this->checkAndUpdateAchievements($user);

        // Get user statistics
        $stats = $this->getUserStats($user);

        // Add admin-specific stats if user is admin
        if (in_array($role, ['admin', 'superadmin'])) {
            $stats = array_merge($stats, $this->getAdminStats());

            // Get top performing students
            $topStudents = $this->getTopStudents();

            // Get popular and low completion materials
            $popularMaterials = $this->getPopularMaterials();
            $lowCompletionMaterials = $this->getLowCompletionMaterials();

            // Get recent system activities
            $recentActivities = $this->getRecentActivities();

            return view('admin.dashboard', compact('user', 'stats', 'topStudents', 'popularMaterials', 'lowCompletionMaterials', 'recentActivities'));
        } else {
            // Get user achievements for display
            $achievements = $this->getUserAchievements($user);

            // Get user statistics
            $stats = $this->getUserStats($user);

            // Get popular materials
            $popularMaterials = DB::table('materi')
                ->orderBy('id', 'asc')
                ->limit(3)
                ->get();

            return view('user.dashboard', compact(
                'user',
                'stats',
                'achievements',
                'popularMaterials'
            ));
        }
    }

    private function getUserStats($user)
    {
        // Get count of completed materials using the materi relationship
        $completedMaterials = $user->materi()
            ->wherePivot('completed', true)
            ->count();

        // Get total materials count
        $totalMaterials = DB::table('materi')->count();

        // Calculate completion percentage
        $materiPercentage = $totalMaterials > 0 ? round(($completedMaterials / $totalMaterials) * 100) : 0;

        // Get count of lessons completed using the lessons relationship
        $completedLessons = $user->lessons()
            ->wherePivot('completed', true)
            ->count();

        // Get total points
        $totalPoints = $user->total_points ?? 0;

        // Get user position in leaderboard
        $userRank = Users::where('role', 'user')
            ->where('total_points', '>', $totalPoints)
            ->count() + 1;

        // Get unlocked achievements count
        $achievementsCount = $user->achievements()
            ->wherePivot('unlocked', true)
            ->count();

        return [
            'completed_materials' => $completedMaterials,
            'total_materials' => $totalMaterials,
            'materi_percentage' => $materiPercentage,
            'completed_lessons' => $completedLessons,
            'total_points' => $totalPoints,
            'rank' => $userRank,
            'achievements' => $achievementsCount
        ];
    }

    private function getUserAchievements($user)
    {
        // Get all achievements
        $allAchievements = Achievement::where('active', true)->get();

        // Get user's unlocked achievements
        $unlockedAchievementIds = $user->achievements()
            ->wherePivot('unlocked', true)
            ->pluck('achievement_id')
            ->toArray();

        // Mark achievements as unlocked if they are in the user's unlocked list
        foreach ($allAchievements as $achievement) {
            $achievement->is_unlocked = in_array($achievement->id, $unlockedAchievementIds);
        }

        return $allAchievements;
    }

    /**
     * Check and update user achievements based on their stats.
     *
     * @param Users $user The user to check achievements for
     * @return array The list of newly unlocked achievements
     */
    public function checkAndUpdateAchievements($user)
    {
        // Get the achievement service from the service container
        $achievementService = app(AchievementService::class);

        // Call the central achievement checking method
        $newlyUnlocked = $achievementService->checkAchievements($user);

        // Flash newly unlocked achievements to the session so they can be displayed
        if (!empty($newlyUnlocked)) {
            \Illuminate\Support\Facades\Log::info("DashboardController: Flashing " . count($newlyUnlocked) . " newly unlocked achievements to session");
            session()->flash('achievement_unlocked', $newlyUnlocked);
        }

        // Return the newly unlocked achievements in case the caller needs them
        return $newlyUnlocked;
    }

    private function getAdminStats()
    {
        // Get total user count (excluding admins)
        $userCount = Users::where('role', 'user')->count();

        // Get total materi count
        $materiCount = Materi::count();

        // Get total lesson count
        $lessonCount = Lesson::count();

        // Calculate completion rate
        $completionRate = 0;
        if ($materiCount > 0) {
            $completedCount = DB::table('user_materi')
                ->where('completed', true)
                ->count();
            $totalPossibleCompletions = $userCount * $materiCount;

            if ($totalPossibleCompletions > 0) {
                $completionRate = round(($completedCount / $totalPossibleCompletions) * 100);
            }
        }

        // Get count of active users this week
        $activeUsersWeek = $this->getActiveUsersCount();

        // Get most popular materi
        $popularMateri = $this->getMostPopularMateri();

        // Get lessons completed this week
        $completedLessonsWeek = $this->getCompletedLessonsThisWeek();

        // Calculate completion rate change
        $completionChange = $this->getCompletionRateChange();

        return [
            'user_count' => $userCount,
            'materi_count' => $materiCount,
            'lesson_count' => $lessonCount,
            'completion_rate' => $completionRate,
            'active_users' => $activeUsersWeek,
            'popular_materi' => $popularMateri,
            'completed_lessons' => $completedLessonsWeek,
            'completion_change' => $completionChange
        ];
    }

    /**
     * Get count of active users in the past week
     */
    private function getActiveUsersCount()
    {
        $lastWeek = Carbon::now()->subDays(7);

        // Count users with activity in the last week
        $activeUsersCount = DB::table('users')
            ->join('user_materi', 'users.id', '=', 'user_materi.user_id')
            ->where('user_materi.last_accessed_at', '>=', $lastWeek)
            ->where('users.role', 'user')
            ->distinct('users.id')
            ->count('users.id');

        return $activeUsersCount;
    }

    /**
     * Get the name of the most popular materi based on access count
     */
    private function getMostPopularMateri()
    {
        $popular = DB::table('user_materi')
            ->join('materi', 'user_materi.materi_id', '=', 'materi.id')
            ->select('materi.title', DB::raw('COUNT(user_materi.user_id) as access_count'))
            ->groupBy('materi.title')
            ->orderByDesc('access_count')
            ->first();

        return $popular ? $popular->title : 'N/A';
    }

    /**
     * Get the number of lessons completed in the past week
     */
    private function getCompletedLessonsThisWeek()
    {
        return DB::table('user_lessons')
            ->where('completed', true)
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->count();
    }

    /**
     * Calculate the percentage change in completion rate compared to the previous week
     */
    private function getCompletionRateChange()
    {
        $currentWeekCompletions = DB::table('user_materi')
            ->where('completed', true)
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->count();

        $previousWeekCompletions = DB::table('user_materi')
            ->where('completed', true)
            ->whereBetween('updated_at', [Carbon::now()->subWeeks(2), Carbon::now()->subWeek()])
            ->count();

        if ($previousWeekCompletions == 0) {
            return $currentWeekCompletions > 0 ? 100 : 0;
        }

        $change = (($currentWeekCompletions - $previousWeekCompletions) / $previousWeekCompletions) * 100;

        return round($change);
    }

    /**
     * Get the top 5 performing students
     */
    private function getTopStudents()
    {
        // Get top 5 users with the most points
        $topStudents = Users::where('role', 'user')
            ->orderByDesc('total_points')
            ->take(5)
            ->get();

        // For each student, get additional statistics
        foreach ($topStudents as $student) {
            // Count completed materials
            $student->completed_materials = $student->materi()
                ->wherePivot('completed', true)
                ->count();

            // Count completed lessons
            $student->completed_lessons = $student->lessons()
                ->wherePivot('completed', true)
                ->count();

            // Get learning streak
            $student->streak = $this->calculateLearningStreak($student->id);

            // Get achievements count
            $student->achievements_count = $student->achievements()
                ->wherePivot('unlocked', true)
                ->count();
        }

        return $topStudents;
    }

    /**
     * Get most popular materials (most accessed)
     */
    private function getPopularMaterials()
    {
        // Get top 3 most accessed materials
        $popularMaterials = DB::table('materi')
            ->join('user_materi', 'materi.id', '=', 'user_materi.materi_id')
            ->select(
                'materi.id',
                'materi.title',
                DB::raw('COUNT(user_materi.user_id) as access_count'),
                DB::raw('SUM(CASE WHEN user_materi.completed = true THEN 1 ELSE 0 END) * 100.0 / COUNT(user_materi.user_id) as completion_rate')
            )
            ->groupBy('materi.id', 'materi.title')
            ->orderByDesc(DB::raw('COUNT(user_materi.user_id)'))
            ->take(3)
            ->get();

        return $popularMaterials;
    }

    /**
     * Get materials with low completion rates
     */
    private function getLowCompletionMaterials()
    {
        return DB::table('materi')
            ->leftJoin('user_materi', 'materi.id', '=', 'user_materi.materi_id')
            ->select(
                'materi.title',
                DB::raw('COUNT(user_materi.user_id) as access_count'),
                DB::raw('(SUM(CASE WHEN user_materi.completed = true THEN 1 ELSE 0 END) * 100.0) / COUNT(user_materi.user_id) as completion_rate')
            )
            ->groupBy('materi.title')
            ->havingRaw('COUNT(user_materi.user_id) > 0') // Only include materials that have been attempted
            ->orderBy('completion_rate', 'asc')
            ->take(3)
            ->get();
    }

    /**
     * Get recent system activities for the admin dashboard
     */
    private function getRecentActivities()
    {
        $activities = [];

        // Get new user registrations (last 24 hours)
        $newUsers = Users::where('created_at', '>=', Carbon::now()->subDay())
            ->count();

        if ($newUsers > 0) {
            $activities[] = [
                'type' => 'new_users',
                'icon' => 'fa-user-plus',
                'color' => 'blue-400',
                'title' => 'Siswa Baru',
                'message' => "{$newUsers} siswa baru mendaftar",
                'time' => Carbon::now()->subHours(rand(1, 3))
            ];
        }

        // Get recently updated materials
        $updatedMaterial = Materi::where('updated_at', '>=', Carbon::now()->subDay())
            ->whereColumn('updated_at', '!=', 'created_at')
            ->latest('updated_at')
            ->first();

        if ($updatedMaterial) {
            $activities[] = [
                'type' => 'material_updated',
                'icon' => 'fa-book',
                'color' => 'green-400',
                'title' => 'Materi Diperbarui',
                'message' => "\"{$updatedMaterial->title}\" telah diperbarui",
                'time' => $updatedMaterial->updated_at
            ];
        }

        // Get new achievement unlocks
        $newAchievements = DB::table('user_achievements')
            ->where('unlocked', true)
            ->where('updated_at', '>=', Carbon::now()->subDay())
            ->count();

        if ($newAchievements > 0) {
            $activities[] = [
                'type' => 'achievements',
                'icon' => 'fa-medal',
                'color' => 'yellow-400',
                'title' => 'Pencapaian Diraih',
                'message' => "{$newAchievements} pencapaian baru diraih oleh siswa",
                'time' => Carbon::now()->subHours(rand(4, 8))
            ];
        }

        // Get new lessons added
        $newLesson = Lesson::where('created_at', '>=', Carbon::now()->subDay())
            ->latest('created_at')
            ->first();

        if ($newLesson) {
            $activities[] = [
                'type' => 'lesson_added',
                'icon' => 'fa-graduation-cap',
                'color' => 'purple-400',
                'title' => 'Pelajaran Baru',
                'message' => "Pelajaran baru \"{$newLesson->title}\" ditambahkan",
                'time' => $newLesson->created_at
            ];
        }

        // Sort activities by time descending
        usort($activities, function ($a, $b) {
            return $b['time'] <=> $a['time'];
        });

        return array_slice($activities, 0, 5); // Limit to 5 recent activities
    }

    private function calculateLearningStreak($userId)
    {
        // This is a placeholder for a more complex streak calculation
        return 0;
    }

    private function calculateUserRank($user)
    {
        // This is a placeholder for rank calculation
        return 0;
    }
}
