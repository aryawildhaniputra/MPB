<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add speed-based achievements
        DB::table('achievements')->insert([
            [
                'name' => 'Kecepatan Hebat',
                'description' => 'Selesaikan bagian dalam waktu kurang dari 1 menit',
                'type' => 'speed',
                'requirement' => 60, // 60 seconds
                'icon' => 'fas fa-bolt',
                'active' => true,
                'points_reward' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kecepatan Kilat',
                'description' => 'Selesaikan bagian dalam waktu kurang dari 30 detik',
                'type' => 'speed',
                'requirement' => 30, // 30 seconds
                'icon' => 'fas fa-bolt',
                'active' => true,
                'points_reward' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove speed-based achievements
        DB::table('achievements')
            ->where('type', 'speed')
            ->whereIn('name', ['Kecepatan Hebat', 'Kecepatan Kilat'])
            ->delete();
    }
};
