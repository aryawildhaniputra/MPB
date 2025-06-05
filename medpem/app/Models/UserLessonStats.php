<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLessonStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'mistakes_count',
        'attempts_count',
        'best_time',
        'total_time',
    ];

    protected $casts = [
        'mistakes_count' => 'integer',
        'attempts_count' => 'integer',
        'best_time' => 'integer',
        'total_time' => 'integer',
    ];

    /**
     * Get the user that owns these stats.
     */
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    /**
     * Get the lesson these stats belong to.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Update statistics with a new attempt time.
     */
    public function updateStats($timeInSeconds, $mistakes = 0)
    {
        // Ensure time is positive and convert to integer (seconds)
        $timeInSeconds = max(0, abs((float) $timeInSeconds));
        $timeInSeconds = (int) round($timeInSeconds);

        // Ensure mistakes is non-negative integer
        $mistakes = max(0, (int) $mistakes);

        $this->attempts_count++;
        $this->mistakes_count += $mistakes;

        // Only add time if it's a reasonable value (less than 1 hour = 3600 seconds)
        if ($timeInSeconds > 0 && $timeInSeconds < 3600) {
            $this->total_time += $timeInSeconds;

            // Update best time if this is faster or first attempt
            if (!$this->best_time || $timeInSeconds < $this->best_time) {
                $this->best_time = $timeInSeconds;
            }
        } else {
            // If time is invalid, just increment total_time by 60 seconds as fallback
            $this->total_time += 60;

            // Set best time to 60 seconds if it's the first attempt with invalid time
            if (!$this->best_time) {
                $this->best_time = 60;
            }
        }

        $this->save();

        return $this;
    }

    /**
     * Get average completion time.
     */
    public function getAverageTimeAttribute()
    {
        if ($this->attempts_count == 0) {
            return 0;
        }

        return round($this->total_time / $this->attempts_count, 2);
    }

    /**
     * Get formatted best time (mm:ss).
     */
    public function getFormattedBestTimeAttribute()
    {
        if (!$this->best_time) {
            return '--:--';
        }

        $minutes = floor($this->best_time / 60);
        $seconds = $this->best_time % 60;

        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    /**
     * Get formatted average time (mm:ss).
     */
    public function getFormattedAverageTimeAttribute()
    {
        $avgTime = $this->average_time;
        if ($avgTime == 0) {
            return '--:--';
        }

        $minutes = floor($avgTime / 60);
        $seconds = $avgTime % 60;

        return sprintf('%02d:%02d', $minutes, $seconds);
    }
}
