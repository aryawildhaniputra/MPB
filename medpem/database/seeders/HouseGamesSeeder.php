<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class HouseGamesSeeder extends Seeder
{
    /**
     * Seed all house-themed games.
     *
     * @return void
     */
    public function run()
    {
        $houseGames = [
            // Word Scramble - House
            [
                'title' => 'Word Scramble - Parts of House',
                'slug' => 'word-scramble-house',
                'description' => 'Susun huruf-huruf acak menjadi kata yang benar tentang bagian rumah.',
                'game_type' => 'word-scramble',
                'difficulty' => 'beginner',
                'points_reward' => 10,
                'estimated_time' => 5,
                'theme' => 'parts-of-house',
                'is_active' => true,
            ],

            // Word Matching - House
            [
                'title' => 'Word Matching - Parts of House',
                'slug' => 'word-matching-house',
                'description' => 'Cocokkan setiap bagian rumah dengan fungsinya.',
                'game_type' => 'word-matching',
                'difficulty' => 'beginner',
                'points_reward' => 10,
                'estimated_time' => 5,
                'theme' => 'parts-of-house',
                'is_active' => true,
            ],

            // Word Search - House
            [
                'title' => 'Word Search - Parts of House',
                'slug' => 'word-search-house',
                'description' => 'Temukan semua kata tentang bagian rumah dalam kotak huruf.',
                'game_type' => 'word-search',
                'difficulty' => 'intermediate',
                'points_reward' => 10,
                'estimated_time' => 8,
                'theme' => 'parts-of-house',
                'is_active' => true,
            ],

            // Image Matching - House
            [
                'title' => 'Image Matching - Parts of House',
                'slug' => 'image-matching-house',
                'description' => 'Pasangkan gambar bagian rumah dengan kata yang tepat.',
                'game_type' => 'image-matching',
                'difficulty' => 'beginner',
                'points_reward' => 10,
                'estimated_time' => 5,
                'theme' => 'parts-of-house',
                'is_active' => true,
            ],
        ];

        foreach ($houseGames as $game) {
            Game::updateOrCreate(
                ['slug' => $game['slug']],
                $game
            );
        }

        $this->command->info('House-themed games seeded successfully!');
    }
}
