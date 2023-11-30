<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(StudentYearSeeder::class);
        $this->call(ChapterSeeder::class);
        $this->call(PastYearSeeder::class);
        $this->call(QuizSeeder::class);
        $this->call(QuizQuestionSeeder::class);
        $this->call(SpmMcqSeeder::class);
        $this->call(SpmMcqQuestionSeeder::class);
    }
}
