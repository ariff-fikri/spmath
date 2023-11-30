<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'student_year_id',
    ];

    public function student_year()
    {
        return $this->belongsTo(StudentYear::class, 'student_year_id', 'id');
    }

    public function chapter_files()
    {
        return $this->hasMany(ChapterFiles::class, 'chapter_id', 'id');
    }
}
