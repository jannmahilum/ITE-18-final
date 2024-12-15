<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;

// First page (student or employee selection)
Route::get('/', function () {
    return view('first'); // first.blade.php
});

// Route for the second page (choose-field)
Route::get('/choose-field', function () {
    $role = request('role');  // Get the role from the query string

    if (!$role) {
        return abort(400, 'Role parameter is missing');  // Return an error if no role is provided
    }

    // Store the role and selected field in the session
    session(['role' => $role]);
    session(['selectedField' => request('field', 'Unknown Field')]);
    return view('choose-field', compact('role'));  // Pass the role to the view
});

// Route for the third page (login page)
Route::get('/login', function () {
    return view('welcome'); // welcome.blade.php
});

// POST route for login (manual login or other forms)
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Google login routes
Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Routes for student flow
Route::middleware('auth')->group(function () {
    Route::get('/student/details', [StudentController::class, 'showDetails'])->name('student.details');
    Route::post('/student/details', [StudentController::class, 'submitDetails'])->name('student.submit');
});

// Routes for employee flow
Route::middleware('auth')->group(function () {
    Route::get('/employee-sections', [EmployeeController::class, 'showSections'])->name('employee.sections');
    Route::post('/employee/create-section', [EmployeeController::class, 'createSection'])->name('employee.createSection');
    Route::get('/section/{section}/grades', [EmployeeController::class, 'showGradesTable'])->name('section.grades');
});
