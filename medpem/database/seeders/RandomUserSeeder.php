<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class RandomUserSeeder extends Seeder
{
    /**
     * Run the database seeds to create additional random users.
     */
    public function run(): void
    {
        $randomUsers = [
            [
                'name' => 'Rina Handayani',
                'username' => 'rinahandayani',
                'points' => 0,
            ],
            [
                'name' => 'Joko Susilo',
                'username' => 'jokosusilo',
                'points' => 0,
            ],
            [
                'name' => 'Maya Sari',
                'username' => 'mayasari',
                'points' => 0,
            ],
            [
                'name' => 'Dian Pratama',
                'username' => 'dianpratama',
                'points' => 0,
            ],
            [
                'name' => 'Andi Gunawan',
                'username' => 'andigunawan',
                'points' => 0,
            ],
        ];

        foreach ($randomUsers as $user) {
            Users::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'password' => Hash::make('12345'),
                'role' => 'user',
                'total_points' => $user['points'],
            ]);
        }
    }
}
