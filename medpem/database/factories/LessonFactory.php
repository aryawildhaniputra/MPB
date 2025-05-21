<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Materi;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraphs(3, true),
            'order' => $this->faker->numberBetween(1, 10),
            'materi_id' => Materi::factory(),
            'duration_minutes' => $this->faker->numberBetween(5, 30),
            'has_quiz' => $this->faker->boolean(70),
            'status' => 'published',
        ];
    }

    /**
     * Indicate that the lesson belongs to a specific materi.
     */
    public function forMateri($materi)
    {
        return $this->state(function (array $attributes) use ($materi) {
            return [
                'materi_id' => $materi instanceof Materi ? $materi->id : $materi,
            ];
        });
    }

    /**
     * Indicate that the lesson has a quiz.
     */
    public function withQuiz()
    {
        return $this->state(function (array $attributes) {
            return [
                'has_quiz' => true,
            ];
        });
    }
}
