<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'device_token',
        'last_activity',
        'total_points',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_activity' => 'datetime'
    ];

    /**
     * The materi that the user has accessed.
     */
    public function materi()
    {
        return $this->belongsToMany(Materi::class, 'user_materi', 'user_id', 'materi_id')
                    ->withPivot('progress', 'completed', 'last_accessed_at', 'points_awarded')
                    ->withTimestamps();
    }

    /**
     * Track progress for a specific materi.
     */
    public function trackMateriProgress($materiId, $progress = null, $completed = null)
    {
        $data = ['last_accessed_at' => now()];

        if ($progress !== null) {
            $data['progress'] = $progress;
        }

        if ($completed !== null) {
            $data['completed'] = $completed;
        }

        // If user has already accessed this materi, update the record
        // Otherwise, create a new record with default values
        $this->materi()->syncWithoutDetaching([
            $materiId => $data
        ]);

        return $this->materi()->where('materi_id', $materiId)->first()->pivot;
    }

    /**
     * Track a visit to a materi without modifying progress.
     * This only updates the last_accessed_at timestamp.
     */
    public function trackMateriVisit($materiId)
    {
        // Check if this materi is already marked as completed
        $existingRecord = $this->materi()
            ->where('materi_id', $materiId)
            ->first();

        // If it's already completed, don't do anything
        if ($existingRecord && $existingRecord->pivot->completed) {
            return $existingRecord->pivot;
        }

        // Only update the last_accessed_at timestamp
        $this->materi()->syncWithoutDetaching([
            $materiId => ['last_accessed_at' => now()]
        ]);

        return $this->materi()->where('materi_id', $materiId)->first()->pivot;
    }

    /**
     * The lessons that the user is taking or has completed.
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'user_lessons', 'user_id', 'lesson_id')
                    ->withPivot('completed', 'current_streak', 'xp_earned', 'started_at', 'completed_at', 'progress')
                    ->withTimestamps();
    }

    /**
     * Get the lesson parts for the user.
     */
    public function lessonParts()
    {
        return $this->hasMany(UserLessonPart::class, 'user_id');
    }

    /**
     * Get lesson parts for a specific lesson.
     */
    public function getPartsForLesson($lessonId)
    {
        return $this->lessonParts()->where('lesson_id', $lessonId)->orderBy('part_number')->get();
    }

    /**
     * Get the lesson statistics for the user.
     */
    public function lessonStats()
    {
        return $this->hasMany(UserLessonStats::class, 'user_id');
    }

    /**
     * Get stats for a specific lesson.
     */
    public function getStatsForLesson($lessonId)
    {
        return $this->lessonStats()->where('lesson_id', $lessonId)->first();
    }

    /**
     * The achievements that the user has earned.
     */
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements', 'user_id', 'achievement_id')
                    ->withPivot('unlocked', 'points_awarded', 'unlocked_at')
                    ->withTimestamps();
    }

    /**
     * Check if a user has unlocked a specific achievement.
     */
    public function hasAchievement($achievementId)
    {
        $userAchievement = $this->achievements()->where('achievement_id', $achievementId)->first();
        return $userAchievement && $userAchievement->pivot->unlocked;
    }

    /**
     * Count how many achievements the user has unlocked.
     */
    public function countUnlockedAchievements()
    {
        return $this->achievements()->wherePivot('unlocked', true)->count();
    }

    /**
     * Get lesson attempts for the user.
     */
    public function lessonAttempts()
    {
        return $this->hasMany(UserHeart::class, 'user_id');
    }

    /**
     * Start a lesson.
     */
    public function startLesson($lessonId, $part = null)
    {
        // If user has already started this lesson, get current progress
        $userLesson = $this->lessons()->where('lesson_id', $lessonId)->first();

        // Initialize data
        $data = [
            'started_at' => now(),
            'completed' => false,
            'current_streak' => 0,
            'xp_earned' => 0,
        ];

        // If there's an existing record, we keep the current progress
        if ($userLesson) {
            $data['progress'] = $userLesson->pivot->progress ?? 0;
        } else {
            $data['progress'] = 0;
        }

        // Create or update the user lesson record
        $this->lessons()->syncWithoutDetaching([
            $lessonId => $data
        ]);

        // Initialize stats if not exists
        UserLessonStats::firstOrCreate([
            'user_id' => $this->id,
            'lesson_id' => $lessonId,
        ], [
            'mistakes_count' => 0,
            'attempts_count' => 1,
            'total_time' => 0,
        ]);

        return $this->lessons()->where('lesson_id', $lessonId)->first()->pivot;
    }

    /**
     * Complete a lesson part.
     */
    public function completePartForLesson($lessonId, $partNumber, $exampleText = null)
    {
        // Find or create the part record
        $part = UserLessonPart::firstOrCreate([
            'user_id' => $this->id,
            'lesson_id' => $lessonId,
            'part_number' => $partNumber,
        ]);

        // Complete the part and award points
        $part->complete($exampleText);

        // Update lesson progress
        $this->updateLessonProgress($lessonId);

        return $part;
    }

    /**
     * Update lesson progress based on completed parts.
     */
    private function updateLessonProgress($lessonId)
    {
        $totalParts = 6; // Assuming max 6 parts per lesson
        $completedParts = $this->lessonParts()
                              ->where('lesson_id', $lessonId)
                              ->where('completed', true)
                              ->count();

        $progress = round(($completedParts / $totalParts) * 100);

        // Update the user lesson progress
        $this->lessons()->syncWithoutDetaching([
            $lessonId => [
                'progress' => $progress,
                'completed' => $progress >= 100,
                'completed_at' => $progress >= 100 ? now() : null,
            ]
        ]);
    }

    /**
     * Complete a lesson.
     */
    public function completeLesson($lessonId, $mistakesCount = 0, $xpEarned = null)
    {
        $lesson = Lesson::find($lessonId);

        if (!$lesson) {
            return null;
        }

        // If xpEarned is not provided, use the lesson's default reward
        if ($xpEarned === null) {
            $xpEarned = $lesson->xp_reward;
        }

        // Get current streak or initialize it
        $userLesson = $this->lessons()->where('lesson_id', $lessonId)->first();
        $currentStreak = $userLesson ? $userLesson->pivot->current_streak : 0;

        // Calculate completion time if we have started_at time
        $startedAt = $userLesson ? $userLesson->pivot->started_at : null;
        $completedAt = now();
        $completionTime = null;

        if ($startedAt) {
            try {
                $startTime = \Carbon\Carbon::parse($startedAt);
                $endTime = \Carbon\Carbon::parse($completedAt);

                // Ensure we get a positive time difference
                $completionTime = abs($endTime->diffInSeconds($startTime));

                // Validate the time is reasonable (between 1 second and 1 hour)
                if ($completionTime < 1 || $completionTime > 3600) {
                    $completionTime = 60; // Default to 1 minute if unreasonable
                }
            } catch (\Exception $e) {
                // If there's any error in time calculation, default to 60 seconds
                $completionTime = 60;
                \Illuminate\Support\Facades\Log::warning("Time calculation error for user {$this->id} lesson {$lessonId}: " . $e->getMessage());
            }
        }

        // Update the lesson completion record
        $this->lessons()->syncWithoutDetaching([
            $lessonId => [
                'completed' => true,
                'completed_at' => $completedAt,
                'current_streak' => $currentStreak + 1,
                'xp_earned' => $xpEarned,
                'progress' => 100
            ]
        ]);

        // Update lesson stats only if we have a valid completion time
        if ($completionTime && $completionTime > 0) {
            $stats = $this->getStatsForLesson($lessonId);
            if ($stats) {
                $stats->updateStats($completionTime, $mistakesCount);
            }
        }

        // Add logging for debugging purposes
        // Lesson completion logged only for errors, not for every success
        if ($completionTime <= 0) {
            \Illuminate\Support\Facades\Log::warning("Invalid completion time for user {$this->id} lesson {$lessonId}: {$completionTime} seconds");
        }

        // Check for achievements
        $achievementService = app(\App\Services\AchievementService::class);
        $newlyUnlocked = $achievementService->checkAchievements($this);

        return [
            'lesson_pivot' => $this->lessons()->where('lesson_id', $lessonId)->first()->pivot,
            'achievements' => $newlyUnlocked
        ];
    }
}
