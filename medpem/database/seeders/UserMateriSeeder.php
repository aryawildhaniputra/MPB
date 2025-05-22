<?php

namespace Database\Seeders;

use App\Models\Materi;
use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserMateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and materi
        $users = Users::where('role', 'user')->get();
        $materis = Materi::all();

        // For each regular user, create initial materi entries but not completed
        foreach ($users as $user) {
            // Initialize 3 materi for each user (or all if less than 3)
            $materiToInitialize = min(3, $materis->count());

            for ($i = 0; $i < $materiToInitialize; $i++) {
                DB::table('user_materi')->insert([
                    'user_id' => $user->id,
                    'materi_id' => $materis[$i]->id,
                    'progress' => 0, // 0% progress
                    'completed' => false,
                    'last_accessed_at' => now()->subDays(rand(1, 10)),
                    'points_awarded' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
