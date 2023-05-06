<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
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
                'title' => 'Quiz For Function and Quadratic Equation in One Variable',
                'student_year_id' => 4,
                'chapter_id' => 1,
            ],
            [
                'title' => 'Quiz For Number Bases',
                'student_year_id' => 4,
                'chapter_id' => 1,
            ],
            [
                'title' => 'Quiz For Matrices',
                'student_year_id' => 5,
                'chapter_id' => 1,
            ],
        ];

        foreach ($quizzes as $key => $quiz) {
            Quiz::create($quiz);
        }
    }
}
