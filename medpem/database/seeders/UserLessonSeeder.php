<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and lessons
        $users = Users::all();
        $lessons = Lesson::orderBy('position')->get();

        // For each user, set up appropriate lesson access
        foreach ($users as $user) {
            // Different setup based on user role
            if ($user->role === 'admin') {
                // Admins get access to all lessons, all marked as completed
                foreach ($lessons as $index => $lesson) {
                    DB::table('user_lessons')->insert([
                        'user_id' => $user->id,
                        'lesson_id' => $lesson->id,
                        'completed' => true,
                        'mistakes_count' => 0,
                        'current_streak' => 5,
                        'xp_earned' => $lesson->xp_reward,
                        'progress' => 100, // 100% progress
                        'started_at' => now()->subDays(10),
                        'completed_at' => now()->subDays(9),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } else if ($user->role === 'user') {
                // For regular users, complete a few lessons
                $lessonCount = min(5, $lessons->count());

                for ($i = 0; $i < $lessonCount; $i++) {
                    $lesson = $lessons[$i];

                    DB::table('user_lessons')->insert([
                        'user_id' => $user->id,
                        'lesson_id' => $lesson->id,
                        'completed' => true,
                        'mistakes_count' => rand(0, 3),
                        'current_streak' => 5,
                        'xp_earned' => $lesson->xp_reward,
                        'progress' => 100, // 100% progress
                        'started_at' => now()->subDays(rand(5, 15)),
                        'completed_at' => now()->subDays(rand(1, 5)),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Add a couple of in-progress lessons
                if ($lessons->count() > $lessonCount) {
                    for ($i = $lessonCount; $i < min($lessonCount + 2, $lessons->count()); $i++) {
                        $lesson = $lessons[$i];
                        $progress = rand(20, 80);

                        DB::table('user_lessons')->insert([
                            'user_id' => $user->id,
                            'lesson_id' => $lesson->id,
                            'completed' => false,
                            'mistakes_count' => rand(0, 2),
                            'current_streak' => rand(1, 3),
                            'xp_earned' => round($lesson->xp_reward * ($progress / 100)),
                            'progress' => $progress,
                            'started_at' => now()->subDays(rand(1, 5)),
                            'completed_at' => null,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}
