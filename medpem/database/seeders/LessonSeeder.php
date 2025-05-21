<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = [
            [
                'title' => 'Parts of My Body',
                'description' => 'Learn the names of body parts in English. Consists of 6 parts:
                    Part 1 (Head & Face) - Head and face parts,
                    Part 2 (Limbs) - Body limbs,
                    Part 3 (Body Parts Detail) - Detailed body parts,
                    Part 4 (Internal Organs) - Internal organs,
                    Part 5 (Body Movements) - Body movements,
                    Part 6 (Body Characteristics) - Body characteristics.',
                'level' => 1,
                'xp_reward' => 15,
                'icon' => 'user',
                'icon_color' => '#FF6B6B',
                'is_active' => true,
                'position' => 1,
                'required_points' => 0,
            ],
            [
                'title' => 'Kinds of Illness',
                'description' => 'Learn about various types of illnesses and health complaints in English. Consists of 6 parts:
                    Part 1 (Common Symptoms) - Common symptoms,
                    Part 2 (Specific Pains) - Specific pains,
                    Part 3 (Medical Situations) - Medical situations,
                    Part 4 (Chronic Conditions) - Chronic conditions,
                    Part 5 (Treatment & Medicine) - Treatment and medicines,
                    Part 6 (Emergency Situations) - Emergency situations.',
                'level' => 1,
                'xp_reward' => 15,
                'icon' => 'heartbeat',
                'icon_color' => '#4ECDC4',
                'is_active' => true,
                'position' => 2,
                'required_points' => 0,
            ],
        ];

        foreach ($lessons as $lesson) {
            Lesson::create($lesson);
        }
    }
}
