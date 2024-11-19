<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});
Route::get('/home', function () {
    return Inertia::render('Home');
});
Route::get('/SoftwareEngineering', function () {
    return Inertia::render('ProgramPage');
});
Route::get('/SoftwareEngineering/WebDesignedProgramming', function () {
    return Inertia::render('CoursePage');
});
Route::get('/login', function () {
    return Inertia::render('LoginPage');
});
Route::get('/register', function () {
    return Inertia::render('RegisterPage');
});
