<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;

/*
|--------------------------------------------------------------------------|
| API Routes                                                              |
|--------------------------------------------------------------------------|
| Here is where you can register API routes for your application. These  |
| routes are loaded by the RouteServiceProvider and all of them will be   |
| assigned to the "api" middleware group. Make something great!            |
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Add the route for creating grades
Route::post('/grades', [GradeController::class, 'store']);
// Route to list all grades
Route::get('/grades', [GradeController::class, 'index']);

// Route to view a specific grade by ID
Route::get('/grades/{id}', [GradeController::class, 'show']);

// In routes/api.php
Route::post('/save-student-records', [StudentController::class, 'saveRecords']);
