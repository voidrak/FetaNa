<?php

namespace App\Http\Controllers;

use App\Models\Choices;
use App\Http\Requests\StoreChoicesRequest;
use App\Http\Requests\UpdateChoicesRequest;

class ChoicesController extends Controller
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
    public function store(StoreChoicesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Choices $choices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChoicesRequest $request, Choices $choices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Choices $choices)
    {
        //
    }
}
