<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmMcq extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'student_year_id',
    ];

    public function student_year()
    {
        return $this->belongsTo(StudentYear::class, 'student_year_id', 'id');
    }

    public function quiz_questions()
    {
        return $this->hasMany(SpmMcqQuestion::class, 'spm_mcq_id', 'id');
    }
}
