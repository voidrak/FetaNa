<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id'
        ]);
        $program_id = $request->query("program_id");
        $courses = Course::where("program_id", $program_id)->get();

        return $courses;
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

        return  $course;
    }

    public function show(Course $course)
    {
        $course->load('questions');
        return $course;
    }

    public function update(Request $request, Course $course)
    {
        $validate = $request->validate([
            'name' => 'required|unique:courses',
        ]);

        $course->update($validate);

        return $course;
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return ["message" => "Deleted Successfully"];
    }
}
