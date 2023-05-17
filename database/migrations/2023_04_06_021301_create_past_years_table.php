<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePastYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('past_years', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('paper_type', [1, 2])->comment('1: paper_1, 2:paper_2');
            $table->text('description')->nullable();
            $table->text('file_name')->nullable();
            $table->text('file_dir')->nullable();
            $table->foreignId('student_year_id')->constrained('student_years')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('past_years');
    }
}
