<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'student_year_id',
    ];

    /**
     * Get the student year associated with this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function studentYear(): BelongsTo
    {
        return $this->belongsTo(StudentYear::class, 'student_year_id', 'id');
    }

    /**
     * Get the chapter files associated with this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chapterFiles(): HasMany
    {
        return $this->hasMany(ChapterFiles::class, 'chapter_id', 'id');
    }
}
