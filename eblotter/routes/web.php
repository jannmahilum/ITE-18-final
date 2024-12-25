<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// First page (student or employee selection)
Route::get('/', function () {
    return view('first'); // first.blade.php
});

// Route for the second page (choose-field)
Route::get('/choose-field', function () {
    $role = request('role');  // Get the role from the query string

    if (!$role) {
        return abort(400, 'Role parameter is missing');
    }

    // Store the role in session
    session(['role' => $role]);

    return view('choose-field', compact('role'));
});

// Route for the third page (login page)
Route::get('/login', function () {
    $role = session('role');  // Retrieve role
    $selectedField = request('field', 'Unknown Field');  // Get field from query

    // Store the selected field in session
    session(['selectedField' => $selectedField]);

    return view('welcome', compact('role', 'selectedField'));
});

// POST route for login
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Google login routes
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Routes for student flow (requires authentication)
Route::middleware('auth')->prefix('student')->group(function () {
    Route::get('details', [StudentController::class, 'showDetails'])->name('student.details');
    Route::post('details', [StudentController::class, 'submitDetails'])->name('student.submit');
    Route::get('fill-up', [StudentController::class, 'showFillUpPage'])->name('student.fillup');  // New route for student 4th page

 // Route to handle saving student score via AJAX
    Route::post('/save-student-score', [StudentController::class, 'saveStudentScore'])->name('save.student.score');


});

// Routes for employee flow (requires authentication)
Route::middleware('auth')->prefix('employee')->group(function () {
    Route::get('sections', [EmployeeController::class, 'showSections'])->name('employee.sections');
    Route::post('create-section', [EmployeeController::class, 'createSection'])->name('employee.createSection');
    Route::get('section/{section}/grades', [EmployeeController::class, 'showGradesTable'])->name('employee.showGradesTable');
    Route::get('fill-up', [EmployeeController::class, 'showEmployeeFillUpPage'])->name('employee.fillup');
    Route::post('add-student-grade', [EmployeeController::class, 'addStudentGrade'])->name('employee.addStudentGrade');
    Route::post('/save-student-grade', [EmployeeController::class, 'saveStudentGrade'])->name('employee.saveStudentGrade');

});


// Test session routes (remove or secure for production)
Route::get('/test-session', function () {
    session(['key' => 'value']);
    return session('key');
});

Route::get('/test-session', function () {
    session()->flush();  // Clear the session
    return 'Session flushed!';
});


// Test-insert route for the sessions table
Route::get('/test-insert', function () {
    DB::table('sessions')->insert([
        'id' => Str::uuid(),
        'user_id' => null,
        'ip_address' => request()->ip(),
        'user_agent' => request()->header('User-Agent'),
        'payload' => json_encode([]),
        'last_activity' => now()->timestamp,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return 'Inserted!';
});


// Logout Route
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Delete Account Route
Route::post('delete-account', [AuthController::class, 'deleteAccount'])->name('user.deleteAccount');


Route::delete('/delete-account', [AuthController::class, 'deleteAccount'])->name('deleteAccount');


Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
