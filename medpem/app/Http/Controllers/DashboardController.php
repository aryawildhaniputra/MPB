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
            return view('user.dashboard', compact('user', 'stats', 'achievements'));
        }
    }

    private function getUserStats($user)
    {
        // Get count of completed materials using the materi relationship
        $completedMaterials = $user->materi()
            ->wherePivot('completed', true)
            ->count();

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

        // Calculate learning streak (placeholder for now)
        $learningStreak = $this->calculateLearningStreak($user->id);

        return [
            'completed_materials' => $completedMaterials,
            'completed_lessons' => $completedLessons,
            'total_points' => $totalPoints,
            'rank' => $userRank,
            'achievements' => $achievementsCount,
            'learning_streak' => $learningStreak
        ];
    }

    /**
     * Calculate a user's current learning streak based on activity
     */
    private function calculateLearningStreak($userId)
    {
        // This would ideally calculate continuous days of activity
        // For now, we'll return a placeholder value between 1-7
        return rand(1, 7);
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
            $achievement->unlocked = in_array($achievement->id, $unlockedAchievementIds);
        }

        return $allAchievements;
    }

    /**
     * Check and update user achievements based on their stats.
     *
     * @param Users $user The user to check achievements for
     * @return void
     */
    public function checkAndUpdateAchievements($user)
    {
        // Get user stats that are needed for achievement calculations
        $completedMaterials = $user->materi()
            ->wherePivot('completed', true)
            ->count();

        $completedLessons = $user->lessons()
            ->wherePivot('completed', true)
            ->count();

        $totalPoints = $user->total_points ?? 0;

        $rank = Users::where('role', 'user')
            ->where('total_points', '>', $totalPoints)
            ->count() + 1;

        $learningStreak = $this->calculateLearningStreak($user->id);

        // Check for lesson-based achievements
        $lessonAchievements = Achievement::where('type', 'lesson')
            ->where('active', true)
            ->get();

        foreach ($lessonAchievements as $achievement) {
            if ($completedLessons >= $achievement->requirement && !$user->hasAchievement($achievement->id)) {
                $achievement->unlockForUser($user->id);
            }
        }

        // Check for materi-based achievements
        $materiAchievements = Achievement::where('type', 'materi')
            ->where('active', true)
            ->get();

        foreach ($materiAchievements as $achievement) {
            if ($completedMaterials >= $achievement->requirement && !$user->hasAchievement($achievement->id)) {
                $achievement->unlockForUser($user->id);
            }
        }

        // Check for points-based achievements
        $pointsAchievements = Achievement::where('type', 'points')
            ->where('active', true)
            ->get();

        foreach ($pointsAchievements as $achievement) {
            if ($totalPoints >= $achievement->requirement && !$user->hasAchievement($achievement->id)) {
                $achievement->unlockForUser($user->id);
            }
        }

        // Check for streak-based achievements
        $streakAchievements = Achievement::where('type', 'streak')
            ->where('active', true)
            ->get();

        foreach ($streakAchievements as $achievement) {
            if ($learningStreak >= $achievement->requirement && !$user->hasAchievement($achievement->id)) {
                $achievement->unlockForUser($user->id);
            }
        }

        // Check for rank-based achievements
        $rankAchievements = Achievement::where('type', 'rank')
            ->where('active', true)
            ->get();

        foreach ($rankAchievements as $achievement) {
            if ($rank <= $achievement->requirement && !$user->hasAchievement($achievement->id)) {
                $achievement->unlockForUser($user->id);
            }
        }
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
        $popularMateri = DB::table('materi')
            ->join('user_materi', 'materi.id', '=', 'user_materi.materi_id')
            ->select('materi.title', DB::raw('COUNT(user_materi.user_id) as access_count'))
            ->groupBy('materi.id', 'materi.title')
            ->orderByDesc(DB::raw('COUNT(user_materi.user_id)'))
            ->first();

        return $popularMateri ? $popularMateri->title : 'Tidak ada data';
    }

    /**
     * Get count of lessons completed in the past week
     */
    private function getCompletedLessonsThisWeek()
    {
        $lastWeek = Carbon::now()->subDays(7);

        $completedCount = DB::table('user_lessons')
            ->where('completed', true)
            ->where('completed_at', '>=', $lastWeek)
            ->count();

        return $completedCount;
    }

    /**
     * Calculate the change in completion rate compared to previous week
     */
    private function getCompletionRateChange()
    {
        // Current week completion rate
        $currentWeekStart = Carbon::now()->startOfWeek();
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();

        // Calculate current week completion rate
        $currentWeekCompletions = DB::table('user_materi')
            ->where('completed', true)
            ->where('updated_at', '>=', $currentWeekStart)
            ->count();

        $currentWeekAttempts = DB::table('user_materi')
            ->where('updated_at', '>=', $currentWeekStart)
            ->count();

        // Calculate last week completion rate
        $lastWeekCompletions = DB::table('user_materi')
            ->where('completed', true)
            ->whereBetween('updated_at', [$lastWeekStart, $currentWeekStart])
            ->count();

        $lastWeekAttempts = DB::table('user_materi')
            ->whereBetween('updated_at', [$lastWeekStart, $currentWeekStart])
            ->count();

        // Calculate rates
        $currentRate = $currentWeekAttempts > 0 ? ($currentWeekCompletions / $currentWeekAttempts) * 100 : 0;
        $lastRate = $lastWeekAttempts > 0 ? ($lastWeekCompletions / $lastWeekAttempts) * 100 : 0;

        // Calculate change
        $change = $currentRate - $lastRate;

        return round($change, 1);
    }

    /**
     * Get top performing students based on points, completion rate and activity
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
        // Get materials with low completion rates (less than 50%)
        $lowCompletionMaterials = DB::table('materi')
            ->join('user_materi', 'materi.id', '=', 'user_materi.materi_id')
            ->select(
                'materi.id',
                'materi.title',
                DB::raw('COUNT(user_materi.user_id) as access_count'),
                DB::raw('SUM(CASE WHEN user_materi.completed = true THEN 1 ELSE 0 END) * 100.0 / COUNT(user_materi.user_id) as completion_rate')
            )
            ->groupBy('materi.id', 'materi.title')
            ->having(DB::raw('SUM(CASE WHEN user_materi.completed = true THEN 1 ELSE 0 END) * 100.0 / COUNT(user_materi.user_id)'), '<', 50)
            ->having(DB::raw('COUNT(user_materi.user_id)'), '>=', 3) // At least 3 students attempted
            ->orderBy(DB::raw('SUM(CASE WHEN user_materi.completed = true THEN 1 ELSE 0 END) * 100.0 / COUNT(user_materi.user_id)'))
            ->take(2)
            ->get();

        return $lowCompletionMaterials;
    }

    /**
     * Get recent system activities for admin dashboard
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
                'type' => 'new_lesson',
                'icon' => 'fa-tasks',
                'color' => 'purple-400',
                'title' => 'Pelajaran Baru',
                'message' => "Pelajaran \"{$newLesson->title}\" telah ditambahkan",
                'time' => $newLesson->created_at
            ];
        }

        // Sort activities by time (most recent first)
        usort($activities, function($a, $b) {
            return $b['time']->timestamp - $a['time']->timestamp;
        });

        return $activities;
    }
}
