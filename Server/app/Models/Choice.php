<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    /** @use HasFactory<\Database\Factories\ChoiceFactory> */
    use HasFactory;

    protected $fillable = ['choice_text', 'question_id', 'is_correct'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
