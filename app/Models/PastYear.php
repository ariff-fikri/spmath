<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'paper_type',
        'student_year_id',
        'file_name',
        'file_dir',
    ];

    public function student_year()
    {
        return $this->belongsTo(StudentYear::class, 'student_year_id', 'id');
    }
}
