<?php

namespace Database\Seeders;

use App\Models\Users;
use App\Models\Lesson;
use App\Models\UserLessonStats;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLessonStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing user_lessons to create stats for
        $userLessons = DB::table('user_lessons')->get();

        foreach ($userLessons as $userLesson) {
            $user = Users::find($userLesson->user_id);
            $lesson = Lesson::find($userLesson->lesson_id);

            if (!$user || !$lesson) continue;

            // Generate realistic stats based on user progress
            $progress = $userLesson->progress ?? 0;
            $isCompleted = $userLesson->completed ?? false;
            $isStarted = $userLesson->started_at !== null;

            // Calculate realistic stats
            $mistakesCount = 0;
            $attemptsCount = 1;
            $bestTime = null;
            $totalTime = 0;

            if ($isStarted) {
                // More mistakes for beginners, fewer for experienced users
                $mistakesCount = $user->role === 'admin' ? 0 : rand(0, 5);

                // Multiple attempts if there were many mistakes
                $attemptsCount = $mistakesCount > 3 ? rand(1, 3) : 1;

                if ($progress > 0) {
                    // Time in seconds - realistic completion times
                    if ($user->role === 'admin') {
                        $bestTime = rand(60, 180); // 1-3 minutes for admin
                    } else {
                        $bestTime = rand(120, 600); // 2-10 minutes for regular users
                    }

                    $totalTime = $bestTime * $attemptsCount;

                    // Add some variation for multiple attempts
                    if ($attemptsCount > 1) {
                        $totalTime += rand(60, 300);
                    }
                }
            }

            UserLessonStats::firstOrCreate([
                'user_id' => $userLesson->user_id,
                'lesson_id' => $userLesson->lesson_id,
            ], [
                'mistakes_count' => $mistakesCount,
                'attempts_count' => $attemptsCount,
                'best_time' => $bestTime,
                'total_time' => $totalTime,
            ]);
        }
    }
}
