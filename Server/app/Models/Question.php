<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    protected $fillable = ['question_text', 'created_by', 'course_id', 'correct_choice_id'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function correctChoice()
    {
        return $this->belongsTo(Choice::class, 'correct_choice_id');
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
