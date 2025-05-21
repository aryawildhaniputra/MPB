<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default users
        Users::updateOrCreate(
            ['username' => 'user'],
            [
            'name' => 'User',
            'password' => Hash::make('123'),
            'role' => 'user',
                'total_points' => 0,
            ]
        );

        Users::updateOrCreate(
            ['username' => 'admin'],
            [
            'name' => 'Admin',
            'password' => Hash::make('a123'),
            'role' => 'admin',
                'total_points' => 0,
            ]
        );

        Users::updateOrCreate(
            ['username' => 'superadmin'],
            [
            'name' => 'Superadmin',
            'password' => Hash::make('sa123'),
            'role' => 'superadmin',
                'total_points' => 0,
            ]
        );

        // Add 5 random users with "user" role
        $randomNames = [
            'Budi Santoso',
            'Siti Rahayu',
            'Ahmad Wijaya',
            'Dewi Lestari',
            'Rudi Hermawan'
        ];

        foreach ($randomNames as $index => $name) {
            // Create username from name (lowercase, no spaces)
            $username = strtolower(str_replace(' ', '', $name));

            Users::updateOrCreate(
                ['username' => $username],
                [
                'name' => $name,
                'password' => Hash::make('123'),
                'role' => 'user',
                    'total_points' => 0,
                ]
            );
        }
    }
}
