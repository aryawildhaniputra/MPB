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
                    ->withPivot('completed', 'current_streak', 'xp_earned',
                               'started_at', 'completed_at', 'progress')
                    ->withTimestamps();
    }

    /**
     * Get the user lesson parts for this lesson.
     */
    public function userParts()
    {
        return $this->hasMany(UserLessonPart::class, 'lesson_id');
    }

    /**
     * Get the user lesson stats for this lesson.
     */
    public function userStats()
    {
        return $this->hasMany(UserLessonStats::class, 'lesson_id');
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

        // Get user's parts for this lesson
        $userParts = UserLessonPart::where('user_id', $userId)
                                  ->where('lesson_id', $this->id)
                                  ->get()
                                  ->keyBy('part_number');

        if (!$userLesson) {
            return [
                'started' => false,
                'completed' => false,
                'current_streak' => 0,
                'xp_earned' => 0,
                'progress' => 0,
                'parts' => $this->buildPartsStatus($userParts),
                'unlocked' => true
            ];
        }

        return [
            'started' => (bool)$userLesson->pivot->started_at,
            'completed' => (bool)$userLesson->pivot->completed,
            'current_streak' => $userLesson->pivot->current_streak,
            'xp_earned' => $userLesson->pivot->xp_earned,
            'started_at' => $userLesson->pivot->started_at,
            'completed_at' => $userLesson->pivot->completed_at,
            'progress' => $userLesson->pivot->progress ?? 0,
            'parts' => $this->buildPartsStatus($userParts),
            'unlocked' => true
        ];
    }

    /**
     * Build parts status array from user parts collection.
     */
    private function buildPartsStatus($userParts)
    {
        $parts = [];

        for ($i = 1; $i <= 6; $i++) {
            $part = $userParts->get($i);

            $parts["part{$i}_completed"] = $part ? $part->completed : false;
            $parts["part{$i}_points_awarded"] = $part ? $part->points_awarded : false;
            $parts["part{$i}_example"] = $part ? $part->example_text : null;
            $parts["part{$i}_completed_at"] = $part ? $part->completed_at : null;
        }

        return $parts;
    }
}
