<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'type',
        'requirement',
        'points_reward',
        'active',
    ];

    /**
     * Get the users who have this achievement.
     */
    public function users()
    {
        return $this->belongsToMany(Users::class, 'user_achievements', 'achievement_id', 'user_id')
                    ->withPivot('unlocked', 'points_awarded', 'unlocked_at')
                    ->withTimestamps();
    }

    /**
     * Check if this achievement is unlocked for a specific user.
     */
    public function isUnlockedByUser($userId)
    {
        $userAchievement = $this->users()->where('user_id', $userId)->first();
        return $userAchievement && $userAchievement->pivot->unlocked;
    }

    /**
     * Unlock this achievement for a user and award points if applicable.
     */
    public function unlockForUser($userId)
    {
        // Check if already unlocked
        if ($this->isUnlockedByUser($userId)) {
            return null;
        }

        // Update or create record
        $this->users()->syncWithoutDetaching([
            $userId => [
                'unlocked' => true,
                'unlocked_at' => now(),
            ]
        ]);

        // Award points if not already awarded
        $userAchievement = $this->users()->where('user_id', $userId)->first();

        if (!$userAchievement->pivot->points_awarded) {
            $user = Users::find($userId);
            if ($user) {
                $user->increment('total_points', $this->points_reward);
            }

            $this->users()->updateExistingPivot($userId, [
                'points_awarded' => true
            ]);
        }

        return $this->users()->where('user_id', $userId)->first()->pivot;
    }
}
