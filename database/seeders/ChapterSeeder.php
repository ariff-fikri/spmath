<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chapters = [
            [
                'name' => 'Function and Quadratic Equation in One Variable',
                'description' => 'A quadratic expression in one variable is an expression whose highest power of the variable is two.',
                'student_year_id' => 4,
            ],
            [
                'name' => 'Number Bases',
                'description' => 'The number system consists of various number bases.',
                'student_year_id' => 4,
            ],
            [
                'name' => 'Logic Reasoning',
                'description' => 'A statement is a sentence whose truth value can be determined, i.e. either true or false, but not both.',
                'student_year_id' => 4,
            ],
            [
                'name' => 'Variations',
                'description' => 'A direct variable describes the relationship between two variables, with the condition when one variable y
                 increases then the variable x also increases at the same rate and vice versa. This relationship is also written as y varies directly with x.',
                'student_year_id' => 5,
            ],
            [
                'name' => 'Matrices',
                'description' => 'A matrix is ​​a number arranged in rows and columns to form a rectangular or square array.',
                'student_year_id' => 5,
            ],
            [
                'name' => ' Consumer Mathematics: Insurance',
                'description' => 'Road accidents that injure the driver and passengers of the vehicle involved, destruction of property due to fire, high medical bills due to critical illness and so on may happen in our lives.',
                'student_year_id' => 5,
            ],
        ];

        foreach ($chapters as $key => $chapter) {
            Chapter::create($chapter);
        }
    }
}
