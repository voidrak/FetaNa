<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});
Route::get('/home', function () {
    return Inertia::render('Home/Home');
});
Route::get('/SoftwareEngineering', function () {
    return Inertia::render('ProgramPage/ProgramPage');
});
