<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $valuated = $request->validate([
            "question_text" => [
                'required',
                Rule::unique('questions')->where(function ($query) use ($request) {
                    return $query->where('course_id', $request->course_id);
                }),
            ],
            "course_id" => "required|exists:courses,id",

        ]);

        return $request->user()->questions()->create($valuated);
    }

    public function show(Question $question)
    {
        //
    }

    public function update(Request $request, Question $question)
    {
        //
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully'], 200);
    }
}
