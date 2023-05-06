<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'student_year_id',
        'chapter_id',
    ];

    public function student_year()
    {
        return $this->belongsTo(StudentYear::class, 'student_year_id', 'id');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id', 'id');
    }

    public function quiz_questions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id', 'id');
    }
}
