<?php

namespace Database\Seeders;

use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class QuizQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizzes = [
            [
                'title' => 'What is the axis of symmetry for the following equation?',
                'quiz_id' => 1,
                'choice_a' => 'x=-1',
                'choice_b' => 'x=1',
                'choice_c' => 'x=-8',
                'choice_d' => 'x=8',
                'correct_answer' => 'b',
            ],
            [
                'title' => 'Solve the quadratic equation, <br>(y + 3)(y – 4) = 30',
                'quiz_id' => 1,
                'choice_a' => 'x=12',
                'choice_b' => 'x=-1',
                'choice_c' => 'x=-81',
                'choice_d' => 'x=8',
                'correct_answer' => 'c',
            ],
            [
                'title' => 'What is the y intercept for the equation: <br>y = -8x<sup>2</sup> + 3x - 7',
                'quiz_id' => 1,
                'choice_a' => 'x=-1',
                'choice_b' => 'x=1',
                'choice_c' => 'x=-8',
                'choice_d' => 'x=8',
                'correct_answer' => 'b',
            ],
        ];

        foreach ($quizzes as $key => $quiz) {
            QuizQuestion::create($quiz);
        }
    }
}
