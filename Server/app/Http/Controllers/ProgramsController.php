<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use App\Http\Requests\StoreProgramsRequest;
use App\Http\Requests\UpdateProgramsRequest;

class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgramsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Programs $programs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramsRequest $request, Programs $programs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programs $programs)
    {
        //
    }
}
