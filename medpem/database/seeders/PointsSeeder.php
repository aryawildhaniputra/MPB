<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed initial points to users
        if (Schema::hasTable('users')) {
            $users = DB::table('users')->get();

            foreach ($users as $user) {
                // Only update if total_points is null
                if ($user->total_points === null) {
                    // Set points to 0
                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['total_points' => 0]);

                    $this->command->info("Set 0 points to user {$user->username}");
                }
            }
            $this->command->info('Points seeding completed!');
        } else {
            $this->command->error('Users table not found!');
        }
    }
}
