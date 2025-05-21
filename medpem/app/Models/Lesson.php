<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'level',
        'xp_reward',
        'icon',
        'icon_color',
        'is_active',
        'position'
    ];

    /**
     * Get the questions for the lesson.
     */
    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('position');
    }

    /**
     * Get the users that are taking this lesson.
     */
    public function users()
    {
        return $this->belongsToMany(Users::class, 'user_lessons', 'lesson_id', 'user_id')
                    ->withPivot('completed', 'mistakes_count', 'current_streak', 'xp_earned',
                               'started_at', 'completed_at', 'progress',
                               'part1_completed', 'part2_completed', 'part3_completed',
                               'part1_points_awarded', 'part2_points_awarded', 'part3_points_awarded',
                               'part1_example', 'part2_example', 'part3_example')
                    ->withTimestamps();
    }

    /**
     * Check if a user has completed this lesson.
     */
    public function isCompletedByUser($userId)
    {
        $userLesson = $this->users()->where('user_id', $userId)->first();
        return $userLesson && $userLesson->pivot->completed;
    }

    /**
     * Get the completion status for a specific user.
     */
    public function getCompletionStatusForUser($userId)
    {
        $userLesson = $this->users()->where('user_id', $userId)->first();

        if (!$userLesson) {
            return [
                'started' => false,    // Not started
                'completed' => false,  // Not completed
                'mistakes_count' => 0,
                'current_streak' => 0,
                'xp_earned' => 0,
                'progress' => 0,
                'part1_completed' => false,
                'part2_completed' => false,
                'part3_completed' => false,
                'part1_example' => null,
                'part2_example' => null,
                'part3_example' => null,
                'unlocked' => true     // Always unlocked
            ];
        }

        return [
            'started' => (bool)$userLesson->pivot->started_at,
            'completed' => (bool)$userLesson->pivot->completed,
            'mistakes_count' => $userLesson->pivot->mistakes_count,
            'current_streak' => $userLesson->pivot->current_streak,
            'xp_earned' => $userLesson->pivot->xp_earned,
            'started_at' => $userLesson->pivot->started_at,
            'completed_at' => $userLesson->pivot->completed_at,
            'progress' => $userLesson->pivot->progress ?? 0,
            'part1_completed' => (bool)$userLesson->pivot->part1_completed,
            'part2_completed' => (bool)$userLesson->pivot->part2_completed,
            'part3_completed' => (bool)$userLesson->pivot->part3_completed,
            'part1_example' => $userLesson->pivot->part1_example,
            'part2_example' => $userLesson->pivot->part2_example,
            'part3_example' => $userLesson->pivot->part3_example,
            'unlocked' => true  // Always unlocked
        ];
    }
}
