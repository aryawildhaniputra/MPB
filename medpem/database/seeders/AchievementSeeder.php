<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing achievements
        Achievement::truncate();

        // Material completion achievements - keeping these as requested (1, 3, 5 materials)
        $this->createMateriCompletionAchievements();

        // Bagian (section) completion achievements for "Belajar Singkat"
        $this->createBagianCompletionAchievements();

        // Add short learning materi completion achievements
        $this->createBelajarSingkatMateriAchievements();

        // Speed-based achievements for completing sections/bagian quickly
        $this->createSpeedAchievements();

        // Points-based achievements
        $this->createPointsAchievements();
    }

    /**
     * Create materi completion achievements
     * Keep these as requested for 1, 3, and 5 materials
     */
    private function createMateriCompletionAchievements(): void
    {
        $achievements = [
            [
                'name' => 'Pembaca Pemula',
                'description' => 'Menyelesaikan 1 materi',
                'icon' => 'book-bronze.png',
                'type' => 'materi_completion',
                'requirement' => 1,
                'points_reward' => 5,
            ],
            [
                'name' => 'Pembaca Aktif',
                'description' => 'Menyelesaikan 3 materi',
                'icon' => 'book-silver.png',
                'type' => 'materi_completion',
                'requirement' => 3,
                'points_reward' => 10,
            ],
            [
                'name' => 'Kutu Buku',
                'description' => 'Menyelesaikan 5 materi',
                'icon' => 'book-gold.png',
                'type' => 'materi_completion',
                'requirement' => 5,
                'points_reward' => 20,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }

    /**
     * Create Bagian (section) completion achievements for "Belajar Singkat"
     * As requested: 1, 3, and 6 sections
     */
    private function createBagianCompletionAchievements(): void
    {
        $achievements = [
            [
                'name' => 'Penjelajah Bagian',
                'description' => 'Menyelesaikan 1 bagian pelajaran',
                'icon' => 'section-bronze.png',
                'type' => 'bagian_completion',
                'requirement' => 1,
                'points_reward' => 5,
            ],
            [
                'name' => 'Penguasa Bagian',
                'description' => 'Menyelesaikan 3 bagian pelajaran',
                'icon' => 'section-silver.png',
                'type' => 'bagian_completion',
                'requirement' => 3,
                'points_reward' => 10,
            ],
            [
                'name' => 'Master Bagian',
                'description' => 'Menyelesaikan 6 bagian pelajaran',
                'icon' => 'section-gold.png',
                'type' => 'bagian_completion',
                'requirement' => 6,
                'points_reward' => 20,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }

    /**
     * Create achievements for completing materials in "Belajar Singkat"
     * As requested: 1 and 2 materials
     */
    private function createBelajarSingkatMateriAchievements(): void
    {
        $achievements = [
            [
                'name' => 'Pelengkap Belajar Singkat',
                'description' => 'Menyelesaikan 1 materi di Belajar Singkat',
                'icon' => 'short-bronze.png',
                'type' => 'belajar_singkat_materi',
                'requirement' => 1,
                'points_reward' => 15,
            ],
            [
                'name' => 'Ahli Belajar Singkat',
                'description' => 'Menyelesaikan 2 materi di Belajar Singkat',
                'icon' => 'short-gold.png',
                'type' => 'belajar_singkat_materi',
                'requirement' => 2,
                'points_reward' => 30,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }

    /**
     * Create points-based achievements
     */
    private function createPointsAchievements(): void
    {
        $achievements = [
            [
                'name' => 'Pengumpul Poin',
                'description' => 'Mengumpulkan 50 poin',
                'icon' => 'points-bronze.png',
                'type' => 'points',
                'requirement' => 50,
                'points_reward' => 5,
            ],
            [
                'name' => 'Kolektor Poin',
                'description' => 'Mengumpulkan 100 poin',
                'icon' => 'points-silver.png',
                'type' => 'points',
                'requirement' => 100,
                'points_reward' => 10,
            ],
            [
                'name' => 'Bank Poin',
                'description' => 'Mengumpulkan 250 poin',
                'icon' => 'points-gold.png',
                'type' => 'points',
                'requirement' => 250,
                'points_reward' => 20,
            ],
            [
                'name' => 'Raja Poin',
                'description' => 'Mengumpulkan 500 poin',
                'icon' => 'points-platinum.png',
                'type' => 'points',
                'requirement' => 500,
                'points_reward' => 50,
            ],
            [
                'name' => 'Guru Poin',
                'description' => 'Kumpulkan 1000 poin!',
                'type' => 'points',
                'requirement' => 1000,
                'icon' => 'fas fa-trophy',
                'active' => true,
                'points_reward' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }

    /**
     * Create speed-based achievements for completing bagian (sections) quickly
     * As requested: less than 2 minutes, 1 minute, and 30 seconds
     */
    private function createSpeedAchievements(): void
    {
        $achievements = [
            [
                'name' => 'Kecepatan Bagus',
                'description' => 'Selesaikan bagian dalam waktu kurang dari 2 menit',
                'icon' => 'fas fa-bolt',
                'type' => 'speed',
                'requirement' => 120, // 2 minutes in seconds
                'points_reward' => 10,
            ],
            [
                'name' => 'Kecepatan Hebat',
                'description' => 'Selesaikan bagian dalam waktu kurang dari 1 menit',
                'icon' => 'fas fa-bolt',
                'type' => 'speed',
                'requirement' => 60, // 1 minute in seconds
                'points_reward' => 20,
            ],
            [
                'name' => 'Kecepatan Kilat',
                'description' => 'Selesaikan bagian dalam waktu kurang dari 30 detik',
                'icon' => 'fas fa-bolt',
                'type' => 'speed',
                'requirement' => 30, // 30 seconds
                'points_reward' => 30,
            ]
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}
