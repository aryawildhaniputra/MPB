<?php

namespace Database\Seeders;

use App\Models\UserHeart;
use App\Models\Users;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHeartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First truncate the existing data
        DB::table('user_hearts')->truncate();

        // Get all users and lessons
        $users = Users::all();
        $lessons = Lesson::orderBy('position')->get();

        // Create mistake tracking records based on user role
        foreach ($users as $user) {
            if ($user->role === 'admin') {
                // For admin users, create entries for all lessons with 0 mistakes
                foreach ($lessons as $lesson) {
                    UserHeart::create([
                        'user_id' => $user->id,
                        'lesson_id' => $lesson->id,
                        'mistakes_count' => 0, // Admins have no mistakes (for demo purposes)
                    ]);
                }
            }
            // Regular users don't get any user_hearts entries initially
            // These will be created when they start a lesson
        }
    }
}
