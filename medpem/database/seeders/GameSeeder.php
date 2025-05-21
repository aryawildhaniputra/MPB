<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            [
                'title' => 'Word Scramble - Parts of Body',
                'slug' => 'word-scramble-body',
                'description' => 'Arrange the scrambled letters to form correct body part names.',
                'game_type' => 'word-scramble',
                'difficulty' => 'beginner',
                'points_reward' => 10,
                'estimated_time' => 5,
                'theme' => 'parts-of-body',
                'is_active' => true,
            ],
            [
                'title' => 'Word Matching - Parts of Body',
                'slug' => 'word-matching-body',
                'description' => 'Match body part names with their functions.',
                'game_type' => 'word-matching',
                'difficulty' => 'beginner',
                'points_reward' => 10,
                'estimated_time' => 5,
                'theme' => 'parts-of-body',
                'is_active' => true,
            ],
            [
                'title' => 'Word Search - Parts of Body',
                'slug' => 'word-search-body',
                'description' => 'Find and locate body part names in the letter grid.',
                'game_type' => 'word-search',
                'difficulty' => 'intermediate',
                'points_reward' => 10,
                'estimated_time' => 8,
                'theme' => 'parts-of-body',
                'is_active' => true,
            ],
            [
                'title' => 'Word Scramble - Kind of Illness',
                'slug' => 'word-scramble-illness',
                'description' => 'Arrange the scrambled letters to form correct illness names in English.',
                'game_type' => 'word-scramble',
                'difficulty' => 'beginner',
                'points_reward' => 10,
                'estimated_time' => 5,
                'theme' => 'kind-of-illness',
                'is_active' => true,
            ],
            [
                'title' => 'Word Matching - Kind of Illness',
                'slug' => 'word-matching-illness',
                'description' => 'Match illness names with their appropriate characteristics.',
                'game_type' => 'word-matching',
                'difficulty' => 'intermediate',
                'points_reward' => 10,
                'estimated_time' => 7,
                'theme' => 'kind-of-illness',
                'is_active' => true,
            ],
            [
                'title' => 'Word Search - Kind of Illness',
                'slug' => 'word-search-illness',
                'description' => 'Find and locate illness names in the letter grid.',
                'game_type' => 'word-search',
                'difficulty' => 'intermediate',
                'points_reward' => 10,
                'estimated_time' => 8,
                'theme' => 'kind-of-illness',
                'is_active' => true,
            ],
            [
                'title' => 'Word Scramble - Parts of House',
                'slug' => 'word-scramble-house',
                'description' => 'Arrange the scrambled letters to form correct house part names.',
                'game_type' => 'word-scramble',
                'difficulty' => 'beginner',
                'points_reward' => 10,
                'estimated_time' => 5,
                'theme' => 'parts-of-house',
                'is_active' => true,
            ],
            [
                'title' => 'Word Matching - Parts of House',
                'slug' => 'word-matching-house',
                'description' => 'Match each house part with its function.',
                'game_type' => 'word-matching',
                'difficulty' => 'beginner',
                'points_reward' => 10,
                'estimated_time' => 5,
                'theme' => 'parts-of-house',
                'is_active' => true,
            ],
            [
                'title' => 'Word Search - Parts of House',
                'slug' => 'word-search-house',
                'description' => 'Find all house part names in the letter grid.',
                'game_type' => 'word-search',
                'difficulty' => 'intermediate',
                'points_reward' => 10,
                'estimated_time' => 8,
                'theme' => 'parts-of-house',
                'is_active' => true,
            ],
            [
                'title' => 'Image Matching - Parts of House',
                'slug' => 'image-matching-house',
                'description' => 'Match house part images with the correct words.',
                'game_type' => 'image-matching',
                'difficulty' => 'beginner',
                'points_reward' => 10,
                'estimated_time' => 5,
                'theme' => 'parts-of-house',
                'is_active' => true,
            ],
            [
                'title' => 'Word Hangman - Parts of Body',
                'slug' => 'word-hangman-body',
                'description' => 'Guess the hidden body part words by selecting the correct letters.',
                'game_type' => 'word-hangman',
                'difficulty' => 'intermediate',
                'points_reward' => 10,
                'estimated_time' => 7,
                'theme' => 'parts-of-body',
                'is_active' => true,
            ],
            [
                'title' => 'Sentence Scramble - Parts of Body',
                'slug' => 'sentence-scramble',
                'description' => 'Arrange scrambled words to form correct sentences about body part usage.',
                'game_type' => 'sentence-scramble',
                'difficulty' => 'intermediate',
                'points_reward' => 15,
                'estimated_time' => 10,
                'theme' => 'parts-of-body',
                'is_active' => true,
            ],
        ];

        foreach ($games as $game) {
            Game::updateOrCreate(
                ['slug' => $game['slug']],
                $game
            );
        }
    }
}
