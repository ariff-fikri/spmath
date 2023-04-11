<?php

namespace Database\Seeders;

use App\Models\StudentYear;
use Illuminate\Database\Seeder;

class StudentYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student_years = [
            [
                'id' => '4',
                'name' => 'Form 4',
            ],
            [
                'id' => '5',
                'name' => 'Form 5',
            ],
        ];

        foreach ($student_years as $key => $student_year) {
            StudentYear::create($student_year);
        }
    }
}
