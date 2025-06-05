<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create SuperAdmin if doesn't exist
        Users::firstOrCreate(
            ['username' => 'superadmin'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('superadmin123'),
                'role' => 'superadmin',
            ]
        );

        // Create additional admin for testing
        Users::firstOrCreate(
            ['username' => 'admintest'],
            [
                'name' => 'Administrator Test',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Create test user
        Users::firstOrCreate(
            ['username' => 'usertest'],
            [
                'name' => 'Test User',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );

        $this->command->info('SuperAdmin and test users created successfully!');
        $this->command->info('SuperAdmin: superadmin / superadmin123');
        $this->command->info('Admin: admintest / admin123');
        $this->command->info('User: usertest / user123');
    }
}
