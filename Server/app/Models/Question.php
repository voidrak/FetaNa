<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    protected $fillable =  [
        'question_text',
        'choice_1',
        'choice_2',
        'choice_3',
        'choice_4',
        'correct_choice',
        'created_by',
        'course_id',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }


    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function bugs()
    {
        return $this->hasMany(Bug::class);
    }
}
