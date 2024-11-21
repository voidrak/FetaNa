<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /** @use HasFactory<\Database\Factories\NoteFactory> */
    use HasFactory;

    protected $fillable = ["note_text", 'created_by', 'question_id'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
