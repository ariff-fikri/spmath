<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'quiz_id',
        'choice_a',
        'choice_b',
        'choice_c',
        'choice_d',
        'correct_answer',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    public static function answer_label($answer_bullet, $id)
    {
        if ($answer_bullet == 'a') {
            return self::where('id', $id)->first()->choice_a ?? '';
        } elseif ($answer_bullet == 'b') {
            return self::where('id', $id)->first()->choice_b ?? '';
        } elseif ($answer_bullet == 'c') {
            return self::where('id', $id)->first()->choice_c ?? '';
        } else {
            return self::where('id', $id)->first()->choice_d ?? '';
        }
    }
}
