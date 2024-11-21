<?php

namespace App\Http\Controllers;

use App\Models\Bugs;
use App\Http\Requests\StoreBugsRequest;
use App\Http\Requests\UpdateBugsRequest;

class BugsController extends Controller
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
    public function store(StoreBugsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bugs $bugs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBugsRequest $request, Bugs $bugs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bugs $bugs)
    {
        //
    }
}
