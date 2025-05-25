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
            'password' => Hash::make('user123'),
            'role' => 'user',
                'total_points' => 0,
            ]
        );

        Users::updateOrCreate(
            ['username' => 'admin'],
            [
            'name' => 'Admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
                'total_points' => 0,
            ]
        );

        Users::updateOrCreate(
            ['username' => 'superadmin'],
            [
            'name' => 'Superadmin',
            'password' => Hash::make('12345'),
            'role' => 'superadmin',
                'total_points' => 0,
            ]
        );

        // Add admin user Arnela
        Users::updateOrCreate(
            ['username' => 'ahl'],
            [
            'name' => 'Arnela Happy Laksanawati',
            'password' => Hash::make('12345'),
            'role' => 'admin',
                'total_points' => 0,
            ]
        );

        // Add users from the list
        $userNames = [
            'ADITYA PANDA PRATAMA',
            'AHMAD DEFAN ANDRIAN',
            'AIRLANGGA DIO SAPUTRA',
            'ARGA AL FALAH',
            'AZKA ABROR',
            'DANI SETYAWAN',
            'ERLANGGA ADI SYAHPUTRA',
            'HERA PUTRA DANIF PRATAMA',
            'JIHAN MARGARETHA PUTRI',
            'MUHAMMAD AZRIL ADITYA',
            'MUHAMMAD RISAL PRASTIYO',
            'NIKI ILHAM MAULANA',
            'RASMA ALIFIAN ABDILLAH',
            'SABRINA INDAH SARI',
            'SAMUDRA RAHARDIAN ADITYA',
            'SHADAM RAMADHANI',
            'SOFIA DWI ASTUTI SAKAN',
            'VALENTINO DIRGANTARA SAPUTRO',
            'ZAFAR IHSAN FAKHRI',
            'ZAZKIA NOVITA PUTRI'
        ];

        foreach ($userNames as $name) {
            // Create username from name (lowercase, no spaces)
            $username = strtolower(str_replace(' ', '', $name));

            Users::updateOrCreate(
                ['username' => $username],
                [
                'name' => $name,
                'password' => Hash::make('12345'),
                'role' => 'user',
                    'total_points' => 0,
                ]
            );
        }

        // Add group users
        $groupNames = ['Group A', 'Group B', 'Group C', 'Group D'];

        foreach ($groupNames as $name) {
            $username = strtolower(str_replace(' ', '', $name));

            Users::updateOrCreate(
                ['username' => $username],
                [
                'name' => $name,
                'password' => Hash::make('12345'),
                'role' => 'user',
                    'total_points' => 0,
                ]
            );
        }
    }
}
