<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class HangmanGamesSeeder extends Seeder
{
    /**
     * Seed all hangman games.
     *
     * @return void
     */
    public function run()
    {
        $hangmanGames = [
            // Word Hangman - Body
            [
                'title' => 'Word Hangman - Parts of Body',
                'slug' => 'word-hangman-body',
                'description' => 'Tebak kata yang tersembunyi dengan memilih huruf yang tepat.',
                'game_type' => 'word-hangman',
                'difficulty' => 'intermediate',
                'points_reward' => 10,
                'estimated_time' => 7,
                'theme' => 'parts-of-body',
                'is_active' => true,
            ],
        ];

        foreach ($hangmanGames as $game) {
            Game::updateOrCreate(
                ['slug' => $game['slug']],
                $game
            );
        }

        $this->command->info('Hangman games seeded successfully!');
    }
}
