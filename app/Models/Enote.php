<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enote extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'chapter_id',
    ];

    public function student_year()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id', 'id');
    }
}
