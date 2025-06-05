<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Users;
use App\Models\UserLessonPart;
use App\Models\UserLessonStats;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Intentionally left empty so users start lessons from scratch.
     */
    public function run(): void
    {
        // Seeder dikosongkan agar user memulai lesson dari awal
        // Users will start lessons fresh without any pre-existing progress

        $this->command->info('UserLessonSeeder: Seeder dikosongkan - users akan memulai lesson dari awal');
    }
}
