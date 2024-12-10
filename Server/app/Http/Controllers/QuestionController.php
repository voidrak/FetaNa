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
        $validated = $request->validate([
            "question_text" => [
                'required',
                "string",
                Rule::unique('questions')->where(function ($query) use ($request) {
                    return $query->where('course_id', $request->course_id);
                }),
            ],
            "course_id" => "required|exists:courses,id",
            "choices" => [
                'required',
                'array',
                'min:4',
                'max:4',
                function ($attribute, $value, $fail) {
                    if (count($value)  !== count(array_unique($value))) {
                        $fail("The Choices Must Be Unique");
                    }
                }
            ],
            "choices.*" => 'required|string',
            "correct_choice" => "required|string| in:" . implode(',', $request->choices),

        ]);


        $validated['choice_1'] = $request->choices[0];
        $validated['choice_2'] = $request->choices[1];
        $validated['choice_3'] = $request->choices[2];
        $validated['choice_4'] = $request->choices[3];

        return $request->user()->questions()->create($validated);
    }

    public function update(Request $request, Question $question)
    {

        $validated = $request->validate([
            "question_text" => [
                "required",
                "string",
                Rule::unique('questions')->where(function ($query) use ($question) {
                    return $query->where("course_id", $question->course_id);
                })->ignore($question->id)
            ],
            "choices" => [
                'required',
                'array',
                'min:4',
                'max:4',
                function ($attribute, $value, $fail) {
                    if (count($value) !== count(array_unique($value))) {
                        $fail("The Choices Must Be Unique");
                    }
                }
            ],
            "choice.*" => "required | string",
            "correct_choice" => "required | string | in:" . implode(',', $request->choices)
        ]);

        $validated['choice_1'] = $request->choices[0];
        $validated['choice_2'] = $request->choices[1];
        $validated['choice_3'] = $request->choices[2];
        $validated['choice_4'] = $request->choices[3];

        return $question->update($validated);
    }

    public function show(Question $question) {}


    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully'], 200);
    }
}


// public function store(Request $request)
// {
//     $validated = $request->validate([

//         "question_id" => [
//             "required ",
//             "exists:questions,id",
//             function ($attribute, $value, $fail) {
//                 $choiceCount = Choice::where('question_id', $value)->count();
//                 if ($choiceCount >= 4) {
//                     $fail("Maximum 4 choices allowed for a question");
//                 }
//             }
//         ],
//         "choice_text" => ['required', Rule::unique('choices')->where(function ($query) use ($request) {
//             return $query->where('question_id', $request->question_id);
//         })],

//         "is_correct" => [
//             "nullable ",
//             " boolean ",
//             function ($attribute, $value, $fail) use ($request) {
//                 if ($value) {
//                     $existingCorrectChoice = Choice::where('question_id', $request->question_id)
//                         ->where('is_correct', true)
//                         ->first();
//                     if ($existingCorrectChoice) {
//                         $fail('Only one correct choice is allowed per question.');
//                     }
//                 }
//                 $incorrectChoiceCount = Choice::where('question_id', $request->question_id)
//                     ->where('is_correct', false)
//                     ->count();
//                 if ($incorrectChoiceCount >= 3) {
//                     if ($value === false) {
//                         $fail('At least one correct choice is required per question.');
//                     }
//                 }
//             },
//         ]
//     ]);


//     return $request->user()->choices()->create($validated);
// }
