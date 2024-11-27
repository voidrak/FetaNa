<?php

namespace App\Http\Controllers;

use App\Models\Program;

use App\Models\Course;
use Illuminate\Http\Request;

class ProgramController extends Controller
{

    public function index()
    {
        $programs = Program::all();
        return ["programs" => $programs];
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required | unique:programs',
        ]);

        $program = $request->user()->programs()->create($validate);
        return ['course' => $program];
    }

    public function show(Program $program)
    {
        return ['program' => $program];
    }

    public function update(Request $request, Program $program)
    {
        $validate = $request->validate([
            'name' => 'required | unique:programs',
        ]);

        $program->update($validate);

        return ['program' => $program];
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return ["message" => "deleted successfully"];
    }
}
