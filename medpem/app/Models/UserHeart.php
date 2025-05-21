<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHeart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'mistakes_count',
    ];

    /**
     * Get the user that owns the attempts.
     */
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    /**
     * Increment mistakes count when user makes a mistake.
     * Returns false if user has exceeded the allowed mistakes.
     */
    public function addMistake($lessonId)
    {
        // Find or create attempt record for this lesson
        $attempt = self::firstOrCreate(
            [
                'user_id' => $this->user_id,
                'lesson_id' => $lessonId,
            ],
            [
                'mistakes_count' => 0
            ]
        );

        // Check if already at max mistakes (max is now 2, which means 3 total attempts)
        if ($attempt->mistakes_count >= 2) {
            return false;
        }

        // Increment mistake count
        $attempt->increment('mistakes_count');
        return true;
    }

    /**
     * Reset mistake count for a lesson
     */
    public static function resetMistakes($userId, $lessonId)
    {
        self::updateOrCreate(
            [
                'user_id' => $userId,
                'lesson_id' => $lessonId,
            ],
            [
                'mistakes_count' => 0
            ]
        );
    }

    /**
     * Get mistakes count for a user and lesson
     */
    public static function getMistakesCount($userId, $lessonId)
    {
        $attempt = self::where('user_id', $userId)
                        ->where('lesson_id', $lessonId)
                        ->first();

        if (!$attempt) {
            return 0;
        }

        return $attempt->mistakes_count;
    }

    /**
     * Get remaining attempts for a lesson
     */
    public static function getRemainingAttempts($userId, $lessonId)
    {
        $mistakesCount = self::getMistakesCount($userId, $lessonId);
        $remaining = 3 - $mistakesCount;

        // Never return 0, instead return 1 as the last attempt
        return max(1, $remaining);
    }
}
