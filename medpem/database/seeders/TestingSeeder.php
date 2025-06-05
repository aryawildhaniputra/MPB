<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
{
    /**
     * Run the database seeds for testing purposes.
     * This seeder can be used to populate the new normalized lesson structure.
     */
    public function run(): void
    {
        $this->command->info('Seeding normalized lesson structure for testing...');

        // Seed user lesson parts
        $this->call(UserLessonPartSeeder::class);
        $this->command->info('UserLessonPart seeded successfully!');

        // Seed user lesson stats
        $this->call(UserLessonStatsSeeder::class);
        $this->command->info('UserLessonStats seeded successfully!');

        $this->command->info('Testing seeder completed!');
    }
}
