<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'type',
        'prompt',
        'prompt_type',
        'image_url',
        'options',
        'correct_answers',
        'hint',
        'position'
    ];

    protected $casts = [
        'options' => 'array',
        'correct_answers' => 'array',
    ];

    /**
     * Get the lesson that owns the question.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Check if the given answer is correct.
     */
    public function isCorrectAnswer($answer)
    {
        // Make sure correct_answers is an array
        $correctAnswers = is_string($this->correct_answers)
            ? json_decode($this->correct_answers, true)
            : $this->correct_answers;

        // For multiple choice or select image questions
        if (in_array($this->type, ['multiple_choice', 'select_image', 'image_choice'])) {
            return in_array($answer, $correctAnswers);
        }

        // For translation or text input questions, do a case-insensitive comparison
        if (in_array($this->type, ['translation', 'text_input'])) {
            foreach ($correctAnswers as $correctAnswer) {
                if (strtolower(trim($answer)) === strtolower(trim($correctAnswer))) {
                    return true;
                }
            }
        }

        // For sentence arrangement questions
        if ($this->type === 'sentence_arrange') {
            // For sentence arrangement, the answer will be a comma-separated string
            // of words, which we need to join to form a sentence
            $submittedSentence = str_replace(',', ' ', $answer);

            // Compare with correct answers
            foreach ($correctAnswers as $correctAnswer) {
                if (strtolower(trim($submittedSentence)) === strtolower(trim($correctAnswer))) {
                    return true;
                }
            }
        }

        return false;
    }
}
