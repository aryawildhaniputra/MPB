<?php

namespace App\Services;

use App\Models\Achievement;
use App\Models\Users;
use App\Models\Lesson;
use App\Models\Materi;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
     * Check and award achievements based on number of bagian (sections) completed
     *
     * @param Users $user
     * @return array Newly unlocked achievements
     */
    protected function checkBagianCompletionAchievements(Users $user)
    {
        $newlyUnlocked = [];

        // Count completed bagian (parts/sections) using direct SQL query to debug
        $completedBagianCount = 0;

        // Log raw SQL to debug part completion status
        $userLessons = DB::table('user_lessons')
            ->where('user_id', $user->id)
            ->get();

        Log::info("Found " . count($userLessons) . " lesson records for user {$user->id}");

        // Check direct database state for debugging
        foreach ($userLessons as $lesson) {
            Log::info("Lesson {$lesson->lesson_id} parts status: " .
                "part1: " . ($lesson->part1_completed ? 'true' : 'false') . ", " .
                "part2: " . ($lesson->part2_completed ? 'true' : 'false') . ", " .
                "part3: " . ($lesson->part3_completed ? 'true' : 'false') . ", " .
                "part4: " . ($lesson->part4_completed ? 'true' : 'false') . ", " .
                "part5: " . ($lesson->part5_completed ? 'true' : 'false') . ", " .
                "part6: " . ($lesson->part6_completed ? 'true' : 'false')
            );

            // Count all completed parts
            if ($lesson->part1_completed) $completedBagianCount++;
            if ($lesson->part2_completed) $completedBagianCount++;
            if ($lesson->part3_completed) $completedBagianCount++;
            if ($lesson->part4_completed) $completedBagianCount++;
            if ($lesson->part5_completed) $completedBagianCount++;
            if ($lesson->part6_completed) $completedBagianCount++;
        }

        Log::info("Direct SQL count shows user {$user->id} has completed {$completedBagianCount} parts");

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

        Log::info("========== SPEED ACHIEVEMENT CHECK ==========");
        Log::info("Checking part completion times for user {$user->id}");

        // Query the database directly to get the most accurate data
        $userLessons = DB::table('user_lessons')
            ->where('user_id', $user->id)
            ->get();

        Log::info("Found " . count($userLessons) . " lesson records using direct DB query");

        // Check all parts for each lesson
        foreach ($userLessons as $lesson) {
            $lessonId = $lesson->lesson_id;

            // Get the lesson's started_at time as a baseline
            $lessonStartedAt = $lesson->started_at ? Carbon::parse($lesson->started_at) : null;

            Log::info("Checking lesson {$lessonId} with start time: " . ($lessonStartedAt ? $lessonStartedAt->toDateTimeString() : 'NULL'));

            if ($lessonStartedAt) {
                // Check each part's completion time
                for ($part = 1; $part <= 6; $part++) {
                    $partCompletedField = 'part' . $part . '_completed';
                    $partCompletedAtField = 'part' . $part . '_completed_at';

                    // Get the values from the database record
                    $partCompleted = $lesson->$partCompletedField ?? false;
                    $partCompletedAt = $lesson->$partCompletedAtField ?? null;

                    Log::info("  Part {$part}: completed = " . ($partCompleted ? 'true' : 'false') .
                             ", completed_at = " . ($partCompletedAt ? $partCompletedAt : 'NULL'));

                    // Check if this part is completed and has a completion timestamp
                    if ($partCompleted && $partCompletedAt) {
                        $partCompletedTime = Carbon::parse($partCompletedAt);

                        // Calculate time to complete this part - use absolute value to handle negative times
                        $durationSeconds = abs($partCompletedTime->diffInSeconds($lessonStartedAt));

                        Log::info("  Lesson {$lessonId} part {$part} completion time: {$durationSeconds} seconds");
                        Log::info("    Started at: {$lessonStartedAt->toDateTimeString()}");
                        Log::info("    Completed at: {$partCompletedTime->toDateTimeString()}");

                        // Update fastest time if this part was completed faster
                        if ($durationSeconds < $fastestPartCompletionSeconds) {
                            $fastestPartCompletionSeconds = $durationSeconds;
                            $fastestLesson = $lessonId;
                            $fastestPart = $part;
                            Log::info("  New fastest part completion time: {$fastestPartCompletionSeconds} seconds (Lesson {$lessonId}, Part {$part})");
                        }
                    }
                }
            } else {
                Log::info("  No start time recorded for lesson {$lessonId}, skipping");
            }
        }

        // If we found a valid completion time
        if ($fastestPartCompletionSeconds < PHP_INT_MAX) {
            Log::info("User {$user->id} fastest part completion time: {$fastestPartCompletionSeconds} seconds (Lesson {$fastestLesson}, Part {$fastestPart})");

            // Get speed achievements where requirement is in seconds
            // In the achievements table, 'requirement' for speed achievements should store the maximum time in seconds
            // For example, "Complete a part in under 60 seconds" would have requirement = 60
            $achievements = Achievement::where('type', 'speed')
                ->where('active', true)
                ->orderBy('requirement', 'desc')
                ->get();

            Log::info("Found " . $achievements->count() . " speed achievements:");
            foreach ($achievements as $achievement) {
                Log::info("  '{$achievement->name}': requirement = {$achievement->requirement}s, user time = {$fastestPartCompletionSeconds}s, eligible = " .
                         ($fastestPartCompletionSeconds <= $achievement->requirement ? 'YES' : 'NO'));
            }

            // Award achievements not already unlocked
            foreach ($achievements as $achievement) {
                // For speed achievements, user's time must be LESS than or EQUAL TO the requirement
                if ($fastestPartCompletionSeconds <= $achievement->requirement) {
                    $hasAchievement = $user->hasAchievement($achievement->id);
                    Log::info("  Achievement {$achievement->name} (id: {$achievement->id}): user already has it? " . ($hasAchievement ? 'YES' : 'NO'));

                    if (!$hasAchievement) {
                        Log::info("  Unlocking speed achievement {$achievement->name} (req: {$achievement->requirement}s) for user {$user->id} with time {$fastestPartCompletionSeconds}s");
                        $pivot = $achievement->unlockForUser($user->id);
                        if ($pivot) {
                            Log::info("  Successfully unlocked achievement {$achievement->name}!");
                            $newlyUnlocked[] = [
                                'achievement' => $achievement,
                                'pivot' => $pivot
                            ];
                        } else {
                            Log::error("  Failed to unlock achievement {$achievement->name}");
                        }
                    }
                }
            }
        } else {
            Log::info("No valid part completion times found for user {$user->id}");
        }

        Log::info("========== END SPEED ACHIEVEMENT CHECK ==========");

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
