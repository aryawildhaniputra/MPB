<?php

namespace App\Services;

use App\Models\Achievement;
use App\Models\Users;
use App\Models\Lesson;
use App\Models\Materi;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\UserLessonPart;

class AchievementService
{
    /**
     * Check if user meets criteria for various achievements and awards them accordingly
     *
     * @param Users $user
     * @return array The list of newly unlocked achievements
     */
    public function checkAchievements(Users $user)
    {
        $newlyUnlocked = [];

        // Check each type of achievement
        $newlyUnlocked = array_merge(
            $newlyUnlocked,
            $this->checkBagianCompletionAchievements($user),
            $this->checkMateriCompletionAchievements($user),
            $this->checkBelajarSingkatMateriAchievements($user),
            $this->checkPointsAchievements($user),
            $this->checkSpeedAchievements($user)
        );

        return $newlyUnlocked;
    }

    /**
     * Check and award achievements based on number of lesson parts completed
     *
     * @param Users $user
     * @return array Newly unlocked achievements
     */
    protected function checkBagianCompletionAchievements(Users $user)
    {
        $newlyUnlocked = [];

        // Count completed parts using the new user_lesson_parts table
        $completedBagianCount = UserLessonPart::where('user_id', $user->id)
                                             ->where('completed', true)
                                             ->count();

        Log::info("User {$user->id} has completed {$completedBagianCount} parts (using new structure)");

        // Get relevant achievements
        $achievements = Achievement::where('type', 'bagian_completion')
            ->where('active', true)
            ->get();

        // Award achievements not already unlocked
        foreach ($achievements as $achievement) {
            if (!$user->hasAchievement($achievement->id)) {
                Log::info("Checking achievement {$achievement->name}: user has {$completedBagianCount}, needed {$achievement->requirement}");
                if ($completedBagianCount >= $achievement->requirement) {
                    Log::info("Unlocking achievement {$achievement->name} for user {$user->id}");
                    $pivot = $achievement->unlockForUser($user->id);
                    if ($pivot) {
                        $newlyUnlocked[] = [
                            'achievement' => $achievement,
                            'pivot' => $pivot
                        ];
                    }
                }
            }
        }

        return $newlyUnlocked;
    }

    /**
     * Check and award achievements based on number of materi completed
     *
     * @param Users $user
     * @return array Newly unlocked achievements
     */
    protected function checkMateriCompletionAchievements(Users $user)
    {
        $newlyUnlocked = [];

        // Count completed materi
        $completedMateriCount = $user->materi()
            ->wherePivot('completed', true)
            ->count();

        // Get relevant achievements
        $achievements = Achievement::where('type', 'materi_completion')
            ->where('active', true)
            ->where('requirement', '<=', $completedMateriCount)
            ->get();

        // Award achievements not already unlocked
        foreach ($achievements as $achievement) {
            if (!$user->hasAchievement($achievement->id)) {
                $pivot = $achievement->unlockForUser($user->id);
                if ($pivot) {
                    $newlyUnlocked[] = [
                        'achievement' => $achievement,
                        'pivot' => $pivot
                    ];
                }
            }
        }

        return $newlyUnlocked;
    }

    /**
     * Check and award achievements based on number of belajar singkat materi completed
     *
     * @param Users $user
     * @return array Newly unlocked achievements
     */
    protected function checkBelajarSingkatMateriAchievements(Users $user)
    {
        $newlyUnlocked = [];

        // Count completed belajar singkat materi
        // Note: 'type' column doesn't exist in materi table yet
        // Setting to 0 until the database schema is updated to support this feature
        $completedBelajarSingkatCount = 0;

        // Get relevant achievements
        $achievements = Achievement::where('type', 'belajar_singkat_materi')
            ->where('active', true)
            ->where('requirement', '<=', $completedBelajarSingkatCount)
            ->get();

        // Award achievements not already unlocked
        foreach ($achievements as $achievement) {
            if (!$user->hasAchievement($achievement->id)) {
                $pivot = $achievement->unlockForUser($user->id);
                if ($pivot) {
                    $newlyUnlocked[] = [
                        'achievement' => $achievement,
                        'pivot' => $pivot
                    ];
                }
            }
        }

        return $newlyUnlocked;
    }

    /**
     * Check and award achievements based on total points accumulated
     *
     * @param Users $user
     * @return array Newly unlocked achievements
     */
    protected function checkPointsAchievements(Users $user)
    {
        $newlyUnlocked = [];

        // Get total points
        $totalPoints = $user->total_points;

        // Get relevant achievements
        $achievements = Achievement::where('type', 'points')
            ->where('active', true)
            ->where('requirement', '<=', $totalPoints)
            ->get();

        // Award achievements not already unlocked
        foreach ($achievements as $achievement) {
            if (!$user->hasAchievement($achievement->id)) {
                $pivot = $achievement->unlockForUser($user->id);
                if ($pivot) {
                    $newlyUnlocked[] = [
                        'achievement' => $achievement,
                        'pivot' => $pivot
                    ];
                }
            }
        }

        return $newlyUnlocked;
    }

    /**
     * Check and award speed-based achievements (completing something quickly)
     *
     * @param Users $user
     * @return array Newly unlocked achievements
     */
    public function checkSpeedAchievements(Users $user)
    {
        $newlyUnlocked = [];

        // Track the fastest part completion times
        $fastestPartCompletionSeconds = PHP_INT_MAX;
        $fastestLesson = null;
        $fastestPart = null;

        // Get all user lessons with start times
        $userLessons = DB::table('user_lessons')
            ->where('user_id', $user->id)
            ->whereNotNull('started_at')
            ->get();

        // Check all completed parts for each lesson
        foreach ($userLessons as $lesson) {
            $lessonId = $lesson->lesson_id;
            $lessonStartedAt = Carbon::parse($lesson->started_at);

            // Get completed parts for this lesson using the new structure
            $completedParts = UserLessonPart::where('user_id', $user->id)
                                           ->where('lesson_id', $lessonId)
                                           ->where('completed', true)
                                           ->whereNotNull('completed_at')
                                           ->get();

            foreach ($completedParts as $part) {
                $partCompletedTime = Carbon::parse($part->completed_at);

                // Calculate time to complete this part
                $durationSeconds = abs($partCompletedTime->diffInSeconds($lessonStartedAt));

                // Update fastest time if this part was completed faster
                if ($durationSeconds < $fastestPartCompletionSeconds) {
                    $fastestPartCompletionSeconds = $durationSeconds;
                    $fastestLesson = $lessonId;
                    $fastestPart = $part->part_number;
                }
            }
        }

        // If we found a valid completion time
        if ($fastestPartCompletionSeconds < PHP_INT_MAX) {
            // Get speed achievements where requirement is in seconds
            $achievements = Achievement::where('type', 'speed')
                ->where('active', true)
                ->orderBy('requirement', 'desc')
                ->get();

            // Award achievements not already unlocked
            foreach ($achievements as $achievement) {
                // For speed achievements, user's time must be LESS than or EQUAL TO the requirement
                if ($fastestPartCompletionSeconds <= $achievement->requirement) {
                    $hasAchievement = $user->hasAchievement($achievement->id);

                    if (!$hasAchievement) {
                        $pivot = $achievement->unlockForUser($user->id);
                        if ($pivot) {
                            $newlyUnlocked[] = [
                                'achievement' => $achievement,
                                'pivot' => $pivot
                            ];
                        }
                    }
                }
            }
        }

        return $newlyUnlocked;
    }

    /**
     * Manually award a specific achievement to a user
     *
     * @param Users $user
     * @param int $achievementId
     * @return array|null
     */
    public function awardAchievement(Users $user, $achievementId)
    {
        $achievement = Achievement::find($achievementId);

        if (!$achievement) {
            return null;
        }

        if (!$user->hasAchievement($achievement->id)) {
            $pivot = $achievement->unlockForUser($user->id);
            if ($pivot) {
                return [
                    'achievement' => $achievement,
                    'pivot' => $pivot
                ];
            }
        }

        return null;
    }
}
