<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(Course $course)
    {
        $courses = Course::all();
        return ["courses" => $courses];
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => [
                'required',
                Rule::unique('courses')->where(function ($query) use ($request) {
                    return $query->where('program_id', $request->program_id);
                }),
            ],
            'program_id' => 'required|exists:programs,id'
        ]);



        $course =  $request->user()->courses()->create($validate);

        return ["course" => $course];
    }

    public function show(Course $course)
    {
        return ["course" => $course];
    }

    public function update(Request $request, Course $course)
    {
        $validate = $request->validate([
            'name' => 'required|unique:courses',
        ]);

        $course->update($validate);

        return ["course" => $course];
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return ["message" => "Deleted Successfully"];
    }
}
