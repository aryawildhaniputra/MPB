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
        $achievements = [
            // Lesson-based Achievements
            [
                'name' => 'Langkah Pertama',
                'description' => 'Selesaikan pelajaran pertamamu',
                'icon' => '🥾',
                'type' => 'lesson',
                'requirement' => 1,
                'points_reward' => 10,
                'active' => true,
            ],
            [
                'name' => 'Pembelajar Bersemangat',
                'description' => 'Selesaikan 3 pelajaran',
                'icon' => '🚀',
                'type' => 'lesson',
                'requirement' => 3,
                'points_reward' => 15,
                'active' => true,
            ],
            [
                'name' => 'Juara Kelas',
                'description' => 'Selesaikan 5 pelajaran',
                'icon' => '🏆',
                'type' => 'lesson',
                'requirement' => 5,
                'points_reward' => 20,
                'active' => true,
            ],
            [
                'name' => 'Pakar Pelajaran',
                'description' => 'Selesaikan 10 pelajaran',
                'icon' => '🎓',
                'type' => 'lesson',
                'requirement' => 10,
                'points_reward' => 30,
                'active' => true,
            ],

            // Materi-based Achievements
            [
                'name' => 'Pembaca Pemula',
                'description' => 'Selesaikan materi pertamamu',
                'icon' => '📚',
                'type' => 'materi',
                'requirement' => 1,
                'points_reward' => 10,
                'active' => true,
            ],
            [
                'name' => 'Pembaca Tekun',
                'description' => 'Selesaikan 3 materi',
                'icon' => '📖',
                'type' => 'materi',
                'requirement' => 3,
                'points_reward' => 15,
                'active' => true,
            ],
            [
                'name' => 'Kutu Buku',
                'description' => 'Selesaikan 5 materi',
                'icon' => '🔍',
                'type' => 'materi',
                'requirement' => 5,
                'points_reward' => 20,
                'active' => true,
            ],

            // Points-based Achievements
            [
                'name' => 'Pengumpul Poin',
                'description' => 'Kumpulkan 50 poin',
                'icon' => '⭐',
                'type' => 'points',
                'requirement' => 50,
                'points_reward' => 10,
                'active' => true,
            ],
            [
                'name' => 'Bintang Kelas',
                'description' => 'Kumpulkan 100 poin',
                'icon' => '🌟',
                'type' => 'points',
                'requirement' => 100,
                'points_reward' => 20,
                'active' => true,
            ],
            [
                'name' => 'Superstar',
                'description' => 'Kumpulkan 200 poin',
                'icon' => '💫',
                'type' => 'points',
                'requirement' => 200,
                'points_reward' => 30,
                'active' => true,
            ],

            // Streak-based Achievements
            [
                'name' => 'Konsisten',
                'description' => 'Belajar 3 hari berturut-turut',
                'icon' => '🔥',
                'type' => 'streak',
                'requirement' => 3,
                'points_reward' => 15,
                'active' => true,
            ],
            [
                'name' => 'Rajin Pantang Menyerah',
                'description' => 'Belajar 5 hari berturut-turut',
                'icon' => '⚡',
                'type' => 'streak',
                'requirement' => 5,
                'points_reward' => 25,
                'active' => true,
            ],

            // Rank-based Achievements
            [
                'name' => 'Top 10',
                'description' => 'Masuk 10 besar di papan peringkat',
                'icon' => '🏅',
                'type' => 'rank',
                'requirement' => 10,
                'points_reward' => 20,
                'active' => true,
            ],
            [
                'name' => 'Pemenang',
                'description' => 'Masuk 3 besar di papan peringkat',
                'icon' => '👑',
                'type' => 'rank',
                'requirement' => 3,
                'points_reward' => 30,
                'active' => true,
            ],

            // Special Achievements
            [
                'name' => 'Pemecah Masalah',
                'description' => 'Selesaikan pelajaran tanpa kesalahan',
                'icon' => '🧩',
                'type' => 'special',
                'requirement' => 0,
                'points_reward' => 15,
                'active' => true,
            ],
            [
                'name' => 'Petualang Pengetahuan',
                'description' => 'Pelajari materi dari semua kategori',
                'icon' => '🧭',
                'type' => 'special',
                'requirement' => 0,
                'points_reward' => 25,
                'active' => true,
            ],
        ];

        foreach ($achievements as $achievementData) {
            Achievement::firstOrCreate(
                ['name' => $achievementData['name']],
                $achievementData
            );
        }
    }
}
