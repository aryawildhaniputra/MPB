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
        try {
            \Illuminate\Support\Facades\Log::info("Achievement {$this->id} ({$this->name}): Attempting to unlock for user {$userId}");

            // Check if already unlocked
            if ($this->isUnlockedByUser($userId)) {
                \Illuminate\Support\Facades\Log::info("Achievement {$this->id}: Already unlocked for user {$userId}");
                return null;
            }

            // Update or create record
            \Illuminate\Support\Facades\Log::info("Achievement {$this->id}: Creating/updating record for user {$userId}");
            $this->users()->syncWithoutDetaching([
                $userId => [
                    'unlocked' => true,
                    'unlocked_at' => now(),
                ]
            ]);

            // Award points if not already awarded
            $userAchievement = $this->users()->where('user_id', $userId)->first();
            \Illuminate\Support\Facades\Log::info("Achievement {$this->id}: Checking if points should be awarded");

            if (!$userAchievement->pivot->points_awarded) {
                $user = Users::find($userId);
                if ($user) {
                    \Illuminate\Support\Facades\Log::info("Achievement {$this->id}: Awarding {$this->points_reward} points to user {$userId}");
                    $user->increment('total_points', $this->points_reward);
                }

                \Illuminate\Support\Facades\Log::info("Achievement {$this->id}: Marking points as awarded");
                $this->users()->updateExistingPivot($userId, [
                    'points_awarded' => true
                ]);
            }

            \Illuminate\Support\Facades\Log::info("Achievement {$this->id}: Successfully unlocked for user {$userId}");
            return $this->users()->where('user_id', $userId)->first()->pivot;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Error unlocking achievement {$this->id} for user {$userId}: " . $e->getMessage());
            \Illuminate\Support\Facades\Log::error($e->getTraceAsString());
            return null;
        }
    }
}
