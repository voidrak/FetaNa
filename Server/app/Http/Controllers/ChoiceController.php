<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChoiceController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            "question_id" => [
                "required ",
                "exists:questions,id",
                function ($attribute, $value, $fail) {
                    $choiceCount = Choice::where('question_id', $value)->count();
                    if ($choiceCount >= 4) {
                        $fail("Maximum 4 choices allowed for a question");
                    }
                }
            ],
            "choice_text" => ['required', Rule::unique('choices')->where(function ($query) use ($request) {
                return $query->where('question_id', $request->question_id);
            })],

            "is_correct" => [
                "nullable ",
                " boolean ",
                function ($attribute, $value, $fail) use ($request) {
                    if ($value) {
                        $existingCorrectChoice = Choice::where('question_id', $request->question_id)
                            ->where('is_correct', true)
                            ->first();
                        if ($existingCorrectChoice) {
                            $fail('Only one correct choice is allowed per question.');
                        }
                    }
                    $incorrectChoiceCount = Choice::where('question_id', $request->question_id)
                        ->where('is_correct', false)
                        ->count();
                    if ($incorrectChoiceCount >= 3) {
                        $correctChoiceExists = Choice::where('question_id', $request->question_id)
                            ->where('is_correct', true)
                            ->exists();
                        if (!$correctChoiceExists) {
                            $fail('At least one correct choice is required per question.');
                        }
                    }
                },
            ]
        ]);


        return $request->user()->choices()->create($validated);
    }

    public function show(Choice $choice)
    {
        //
    }

    public function update(Request $request, Choice $choice)
    {
        //
    }

    public function destroy(Choice $choice)
    {
        //
    }
}
