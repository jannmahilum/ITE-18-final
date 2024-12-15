<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function showDetails()
    {
        return view('student-fill-up'); // student-details.blade.php
    }

    public function submitDetails(Request $request)
    {
        // Handle the form submission for student details
        $validated = $request->validate([
            'id_number' => 'required|numeric',
            'instructor' => 'required|string',
            'section' => 'required|string',
        ]);

        // Process the data as needed (e.g., store it in the database)

        return redirect()->route('student.details')->with('success', 'Details submitted successfully!');
    }
}
