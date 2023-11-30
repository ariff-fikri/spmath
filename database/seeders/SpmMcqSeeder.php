<?php

namespace Database\Seeders;

use App\Models\SpmMcq;
use Illuminate\Database\Seeder;

class SpmMcqSeeder extends Seeder
{
    public function run()
    {
        $quizzes = [
            [
                'title' => 'Quiz For Function and Quadratic Equation in One Variable For SPM MCQ',
            ],
            [
                'title' => 'Quiz For Number Bases',
            ],
            [
                'title' => 'Quiz For Matrices',
            ],
        ];

        foreach ($quizzes as $key => $quiz) {
            SpmMcq::create($quiz);
        }
    }
}
