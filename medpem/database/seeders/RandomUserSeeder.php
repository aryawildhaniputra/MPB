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
                'points' => rand(80, 250),
            ],
            [
                'name' => 'Joko Susilo',
                'username' => 'jokosusilo',
                'points' => rand(80, 250),
            ],
            [
                'name' => 'Maya Sari',
                'username' => 'mayasari',
                'points' => rand(80, 250),
            ],
            [
                'name' => 'Dian Pratama',
                'username' => 'dianpratama',
                'points' => rand(80, 250),
            ],
            [
                'name' => 'Andi Gunawan',
                'username' => 'andigunawan',
                'points' => rand(80, 250),
            ],
        ];

        foreach ($randomUsers as $user) {
            Users::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'password' => Hash::make('123456'),
                'role' => 'user',
                'total_points' => $user['points'],
            ]);
        }
    }
}
