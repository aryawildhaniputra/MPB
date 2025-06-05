<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLessonPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'part_number',
        'completed',
        'points_awarded',
        'example_text',
        'completed_at',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'points_awarded' => 'boolean',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the user that owns this lesson part.
     */
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    /**
     * Get the lesson this part belongs to.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Scope to get parts for a specific user and lesson.
     */
    public function scopeForUserLesson($query, $userId, $lessonId)
    {
        return $query->where('user_id', $userId)->where('lesson_id', $lessonId);
    }

    /**
     * Scope to get completed parts.
     */
    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    /**
     * Mark this part as completed and award points if applicable.
     */
    public function complete($exampleText = null)
    {
        $this->completed = true;
        $this->completed_at = now();

        if ($exampleText) {
            $this->example_text = $exampleText;
        }

        // Award points if not already awarded
        if (!$this->points_awarded) {
            $this->points_awarded = true;

            // Update user's total points
            $user = $this->user;
            $user->total_points = ($user->total_points ?? 0) + 15; // 15 points per part
            $user->save();
        }

        $this->save();

        return $this;
    }

    /**
     * Get completion time in seconds since the lesson was started.
     */
    public function getCompletionTimeAttribute()
    {
        if (!$this->completed_at) {
            return null;
        }

        // Get the user lesson from the pivot table
        $user = $this->user;
        $userLesson = $user->lessons()->where('lesson_id', $this->lesson_id)->first();

        if (!$userLesson || !$userLesson->pivot->started_at) {
            return null;
        }

        return $this->completed_at->diffInSeconds($userLesson->pivot->started_at);
    }
}
