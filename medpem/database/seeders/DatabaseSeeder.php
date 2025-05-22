<?php

namespace Database\Seeders;

use App\Models\Users;
use App\Models\Materi;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First seed users - only essential data
        $this->call(UserSeeder::class);

        // Seed additional random users for leaderboard testing
        $this->call(RandomUserSeeder::class);

        // Then seed content - core content
        $this->call(MateriSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(QuestionSeeder::class);

        // Seed achievements
        $this->call(AchievementSeeder::class);

        // Now seed user-related data
        $this->call(UserHeartSeeder::class);
        $this->call(UserLessonSeeder::class);
        $this->call(UserMateriSeeder::class);

        // Seed games
        $this->call(GameSeeder::class);

        // Ensure house-themed games are properly seeded
        $this->call(HouseGamesSeeder::class);

        // Ensure hangman games are properly seeded
        $this->call(HangmanGamesSeeder::class);
    }
}
