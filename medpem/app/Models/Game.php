<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'game_type',
        'difficulty',
        'points_reward',
        'estimated_time',
        'theme',
        'is_active'
    ];

    /**
     * Get the users who have played this game.
     */
    public function users()
    {
        return $this->belongsToMany(Users::class, 'user_games', 'game_id', 'user_id')
                    ->withPivot('score', 'time_taken', 'completed', 'last_played_at')
                    ->withTimestamps();
    }
}
