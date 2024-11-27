<?php

namespace App\Http\Controllers;

use App\Models\Program;

use App\Models\Course;
use Illuminate\Http\Request;

class ProgramController extends Controller
{

    public function index()
    {
        //
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
        //
    }

    public function update(Request $request, Program $program)
    {
        //
    }

    public function destroy(Program $program)
    {
        //
    }
}
