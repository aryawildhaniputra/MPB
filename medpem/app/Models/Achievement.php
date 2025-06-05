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

            // Award points if this achievement has a points reward and hasn't been awarded yet
            if ($this->points_reward > 0) {
                // Award points and mark as awarded
                $user = Users::find($userId);
                if ($user) {
                    $user->addPoints($this->points_reward);
                    $pivot = $this->users()->where('user_id', $userId)->first()->pivot;
                    $pivot->points_awarded = true;
                    $pivot->save();
                }
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
