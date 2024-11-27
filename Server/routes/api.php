<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProgramController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return "API";
});


// ProgramController

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/programs', [ProgramController::class, 'index']);
    Route::get('/programs/{program}', [ProgramController::class, 'show']);
    Route::post('/programs', [ProgramController::class, 'store'])->middleware(AdminMiddleware::class);
    Route::put('/programs/{program}', [ProgramController::class, 'update'])->middleware(AdminMiddleware::class);
    Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->middleware(AdminMiddleware::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{course}', [CourseController::class, 'show']);
    Route::post('/courses', [CourseController::class, 'store'])->middleware(AdminMiddleware::class);
    Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware(AdminMiddleware::class);
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->middleware(AdminMiddleware::class);
});



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
