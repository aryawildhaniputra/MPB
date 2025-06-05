<?php

namespace Database\Seeders;

use App\Models\Users;
use App\Models\Lesson;
use App\Models\UserLessonPart;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLessonPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing user_lessons to create parts for
        $userLessons = DB::table('user_lessons')->get();

        foreach ($userLessons as $userLesson) {
            $user = Users::find($userLesson->user_id);
            $lesson = Lesson::find($userLesson->lesson_id);

            if (!$user || !$lesson) continue;

            // Determine how many parts to complete based on progress
            $progress = $userLesson->progress ?? 0;
            $completedParts = round(($progress / 100) * 6);

            // Example answers based on lesson content
            $exampleAnswers = [
                'head', 'hand', 'foot', 'eye', 'nose', 'mouth',
                'good morning', 'thank you', 'please', 'excuse me', 'hello', 'goodbye',
                'apple', 'book', 'chair', 'door', 'window', 'table'
            ];

            // Create parts for this user lesson
            for ($part = 1; $part <= 6; $part++) {
                $partCompleted = $part <= $completedParts;

                // Create some incomplete parts for variety
                if ($partCompleted || ($progress > 0 && rand(0, 2) === 0)) {
                    $exampleText = $partCompleted ?
                        $exampleAnswers[array_rand($exampleAnswers)] :
                        null;

                    UserLessonPart::firstOrCreate([
                        'user_id' => $userLesson->user_id,
                        'lesson_id' => $userLesson->lesson_id,
                        'part_number' => $part,
                    ], [
                        'completed' => $partCompleted,
                        'points_awarded' => $partCompleted,
                        'example_text' => $exampleText,
                        'completed_at' => $partCompleted ?
                            now()->subDays(rand(1, 7)) : null,
                    ]);
                }
            }
        }

        // Update user total points based on completed parts
        $users = Users::all();
        foreach ($users as $user) {
            $completedParts = UserLessonPart::where('user_id', $user->id)
                                           ->where('completed', true)
                                           ->where('points_awarded', true)
                                           ->count();

            $user->total_points = $completedParts * 15; // 15 points per part
            $user->save();
        }
    }
}
