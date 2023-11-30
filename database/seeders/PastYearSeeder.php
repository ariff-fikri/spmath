<?php

namespace Database\Seeders;

use App\Models\PastYear;
use Illuminate\Database\Seeder;

class PastYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $past_years = [
            [
                'name' => '2018',
                'description' => 'Paper 1',
                'paper_type' => '1',
                'student_year_id' => 4,
                'file_name' => '2018-paper-1.pdf',
                'file_dir' => 'assets/docs/',
            ],
            [
                'name' => '2018',
                'description' => 'Paper 2',
                'paper_type' => '2',
                'student_year_id' => 5,
                'file_name' => '2018-paper-2.pdf',
                'file_dir' => 'assets/docs/',
            ],
        ];

        foreach ($past_years as $key => $past_year) {
            PastYear::create($past_year);
        }
    }
}
