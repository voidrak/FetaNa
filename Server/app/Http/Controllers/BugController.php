<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use App\Http\Requests\StoreBugRequest;
use App\Http\Requests\UpdateBugRequest;

class BugController extends Controller
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
    public function store(StoreBugRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bug $bug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBugRequest $request, Bug $bug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bug $bug)
    {
        //
    }
}
