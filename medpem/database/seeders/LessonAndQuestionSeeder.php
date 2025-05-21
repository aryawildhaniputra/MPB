<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Question;

class LessonAndQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some lessons
        $lesson1 = Lesson::create([
            'title' => 'Perkenalan Dasar',
            'description' => 'Belajar cara memperkenalkan diri dalam bahasa Inggris dan mengetahui ungkapan-ungkapan dasar yang sering digunakan.',
            'icon' => 'user',
            'icon_color' => '#58CC02',
            'level' => 1,
            'position' => 1,
            'xp_reward' => 20,
            'is_active' => true,
        ]);

        $lesson2 = Lesson::create([
            'title' => 'Salam dan Sapaan',
            'description' => 'Belajar berbagai ungkapan untuk menyapa dan mengucapkan salam dalam bahasa Inggris.',
            'icon' => 'hand-wave',
            'icon_color' => '#1CB0F6',
            'level' => 1,
            'position' => 2,
            'xp_reward' => 20,
            'is_active' => true,
        ]);

        $lesson3 = Lesson::create([
            'title' => 'Hewan dan Gambar',
            'description' => 'Belajar nama-nama hewan dalam bahasa Inggris melalui gambar-gambar menarik.',
            'icon' => 'paw',
            'icon_color' => '#FF9600',
            'level' => 1,
            'position' => 3,
            'xp_reward' => 25,
            'is_active' => true,
        ]);

        $lesson4 = Lesson::create([
            'title' => 'Kalimat Sederhana',
            'description' => 'Belajar menyusun kalimat-kalimat sederhana dalam bahasa Inggris.',
            'icon' => 'pen',
            'icon_color' => '#CE82FF',
            'level' => 2,
            'position' => 4,
            'xp_reward' => 30,
            'is_active' => true,
        ]);

        // Create questions for lesson 1 (at least 4 questions)
        Question::create([
            'lesson_id' => $lesson1->id,
            'type' => 'multiple_choice',
            'prompt' => 'Apa bahasa Inggris dari "Nama saya John"?',
            'prompt_type' => 'text',
            'options' => json_encode(['My name is John', 'I am John', 'John is my name', 'Call me John']),
            'correct_answers' => json_encode(['My name is John']),
            'position' => 1,
        ]);

        Question::create([
            'lesson_id' => $lesson1->id,
            'type' => 'multiple_choice',
            'prompt' => 'Pilih ungkapan yang benar untuk memperkenalkan diri:',
            'prompt_type' => 'text',
            'options' => json_encode(['You name what?', 'I am name John', 'I am John', 'John I am']),
            'correct_answers' => json_encode(['I am John']),
            'position' => 2,
        ]);

        Question::create([
            'lesson_id' => $lesson1->id,
            'type' => 'text_input',
            'prompt' => 'Terjemahkan ke bahasa Inggris: "Senang bertemu denganmu"',
            'prompt_type' => 'text',
            'options' => null,
            'correct_answers' => json_encode(['Nice to meet you', 'Pleasure to meet you', 'Good to meet you']),
            'position' => 3,
        ]);

        Question::create([
            'lesson_id' => $lesson1->id,
            'type' => 'multiple_choice',
            'prompt' => 'Apa bahasa Inggris dari "Saya berasal dari Indonesia"?',
            'prompt_type' => 'text',
            'options' => json_encode(['I from Indonesia', 'I am from Indonesia', 'I come from Indonesia', 'I am come from Indonesia']),
            'correct_answers' => json_encode(['I am from Indonesia', 'I come from Indonesia']),
            'position' => 4,
        ]);

        // Create questions for lesson 2 (at least 4 questions)
        Question::create([
            'lesson_id' => $lesson2->id,
            'type' => 'multiple_choice',
            'prompt' => 'Apa sapaan yang tepat untuk pagi hari?',
            'prompt_type' => 'text',
            'options' => json_encode(['Good morning', 'Good evening', 'Good night', 'Good afternoon']),
            'correct_answers' => json_encode(['Good morning']),
            'position' => 1,
        ]);

        Question::create([
            'lesson_id' => $lesson2->id,
            'type' => 'text_input',
            'prompt' => 'Terjemahkan ke bahasa Inggris: "Apa kabar?"',
            'prompt_type' => 'text',
            'options' => null,
            'correct_answers' => json_encode(['How are you?', 'How are you doing?', 'How do you do?']),
            'position' => 2,
        ]);

        Question::create([
            'lesson_id' => $lesson2->id,
            'type' => 'multiple_choice',
            'prompt' => 'Apa sapaan yang tepat untuk sore hari?',
            'prompt_type' => 'text',
            'options' => json_encode(['Good morning', 'Good evening', 'Good night', 'Good afternoon']),
            'correct_answers' => json_encode(['Good afternoon']),
            'position' => 3,
        ]);

        Question::create([
            'lesson_id' => $lesson2->id,
            'type' => 'multiple_choice',
            'prompt' => 'Ungkapan apa yang digunakan untuk meminta kabar?',
            'prompt_type' => 'text',
            'options' => json_encode(['What\'s your name?', 'How are you?', 'Where are you from?', 'How old are you?']),
            'correct_answers' => json_encode(['How are you?']),
            'position' => 4,
        ]);

        // Create questions for lesson 3 (image choice type, at least 4 questions)
        Question::create([
            'lesson_id' => $lesson3->id,
            'type' => 'image_choice',
            'prompt' => 'https://cdn.pixabay.com/photo/2014/11/30/14/11/cat-551554_1280.jpg',
            'prompt_type' => 'image',
            'options' => json_encode(['Cat', 'Dog', 'Bird', 'Fish']),
            'correct_answers' => json_encode(['Cat']),
            'position' => 1,
        ]);

        Question::create([
            'lesson_id' => $lesson3->id,
            'type' => 'image_choice',
            'prompt' => 'https://cdn.pixabay.com/photo/2016/12/13/05/15/puppy-1903313_1280.jpg',
            'prompt_type' => 'image',
            'options' => json_encode(['Cat', 'Dog', 'Bird', 'Fish']),
            'correct_answers' => json_encode(['Dog']),
            'position' => 2,
        ]);

        Question::create([
            'lesson_id' => $lesson3->id,
            'type' => 'image_choice',
            'prompt' => 'https://cdn.pixabay.com/photo/2017/02/07/16/47/kingfisher-2046453_1280.jpg',
            'prompt_type' => 'image',
            'options' => json_encode(['Cat', 'Dog', 'Bird', 'Fish']),
            'correct_answers' => json_encode(['Bird']),
            'position' => 3,
        ]);

        Question::create([
            'lesson_id' => $lesson3->id,
            'type' => 'image_choice',
            'prompt' => 'https://cdn.pixabay.com/photo/2016/11/29/09/43/fish-1868703_1280.jpg',
            'prompt_type' => 'image',
            'options' => json_encode(['Cat', 'Dog', 'Bird', 'Fish']),
            'correct_answers' => json_encode(['Fish']),
            'position' => 4,
        ]);

        // Create questions for lesson 4 (sentence arrangement, at least 4 questions)
        Question::create([
            'lesson_id' => $lesson4->id,
            'type' => 'sentence_arrange',
            'prompt' => 'Susun kata-kata berikut menjadi kalimat yang benar:',
            'prompt_type' => 'text',
            'options' => json_encode(['I', 'am', 'a', 'student']),
            'correct_answers' => json_encode(['I am a student']),
            'position' => 1,
        ]);

        Question::create([
            'lesson_id' => $lesson4->id,
            'type' => 'sentence_arrange',
            'prompt' => 'Susun kata-kata berikut menjadi kalimat yang benar:',
            'prompt_type' => 'text',
            'options' => json_encode(['She', 'likes', 'to', 'read', 'books']),
            'correct_answers' => json_encode(['She likes to read books']),
            'position' => 2,
        ]);

        Question::create([
            'lesson_id' => $lesson4->id,
            'type' => 'sentence_arrange',
            'prompt' => 'Susun kata-kata berikut menjadi kalimat yang benar:',
            'prompt_type' => 'text',
            'options' => json_encode(['They', 'are', 'playing', 'football', 'in', 'the', 'park']),
            'correct_answers' => json_encode(['They are playing football in the park']),
            'position' => 3,
        ]);

        Question::create([
            'lesson_id' => $lesson4->id,
            'type' => 'sentence_arrange',
            'prompt' => 'Susun kata-kata berikut menjadi kalimat yang benar:',
            'prompt_type' => 'text',
            'options' => json_encode(['We', 'will', 'go', 'to', 'the', 'beach', 'tomorrow']),
            'correct_answers' => json_encode(['We will go to the beach tomorrow']),
            'position' => 4,
        ]);
    }
}
