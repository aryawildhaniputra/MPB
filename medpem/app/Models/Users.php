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
                    ->withPivot('completed', 'mistakes_count', 'current_streak', 'xp_earned', 'points_awarded', 'started_at', 'completed_at', 'progress')
                    ->withTimestamps();
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
        // If user has already started this lesson, get current progress and completed parts
        $userLesson = $this->lessons()->where('lesson_id', $lessonId)->first();

        // Initialize data
        $data = [
            'started_at' => now(),
            'completed' => false,
            'mistakes_count' => 0,
            'current_streak' => 0,
            'xp_earned' => 0,
        ];

        // If there's an existing record, we keep the current progress
        if ($userLesson) {
            $data['progress'] = $userLesson->pivot->progress ?? 0;
        } else {
            $data['progress'] = 0;
        }

        // If user has already started this lesson, update the record
        // Otherwise, create a new record with default values
        $this->lessons()->syncWithoutDetaching([
            $lessonId => $data
        ]);

        return $this->lessons()->where('lesson_id', $lessonId)->first()->pivot;
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
            $completionTime = $completedAt->diffInSeconds(\Carbon\Carbon::parse($startedAt));
        }

        // We don't need to award points here anymore as they're awarded after each part
        // But we still mark the lesson as completed for tracking purposes

        // Update the lesson completion record
        $this->lessons()->syncWithoutDetaching([
            $lessonId => [
                'completed' => true,
                'mistakes_count' => $mistakesCount,
                'completed_at' => $completedAt,
                'current_streak' => $currentStreak + 1,
                'xp_earned' => $xpEarned,
                'progress' => 100
            ]
        ]);

        // Add logging for debugging purposes
        Log::info("Lesson {$lessonId} marked as completed for user {$this->id}. Points are awarded separately for each part.");

        // Check for achievements
        $achievementService = app(\App\Services\AchievementService::class);
        $newlyUnlocked = $achievementService->checkAchievements($this);

        return [
            'lesson_pivot' => $this->lessons()->where('lesson_id', $lessonId)->first()->pivot,
            'achievements' => $newlyUnlocked
        ];
    }
}
