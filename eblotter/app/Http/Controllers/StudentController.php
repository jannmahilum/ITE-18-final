<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;  // Assuming you have a Student model
use Illuminate\Support\Facades\Schema;

class StudentController extends Controller
{
    public function showDetails()
    {
        $students = Student::all(); // Retrieve all students
        return view('student-fill-up', compact('students')); // Pass the students to the view
    }
    

    public function submitDetails(Request $request)
    {
        $validated = $request->validate([
            'id_number' => 'required|numeric',
            'instructor' => 'required|string',
            'section' => 'required|string',
        ]);

        return redirect()->route('student.details')->with('success', 'Details submitted successfully!');
    }

    // New method to handle saving student scores via AJAX
    public function saveStudentScore(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'studentId' => 'required|exists:students,id', // Ensure student exists
            'section' => 'required|string',
            'scoreType' => 'required|string',
            'value' => 'required|numeric', // Ensure the score value is numeric
        ]);

        // Find the student
        $student = Student::find($validated['studentId']);
        
        // If the student is not found, return an error
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }

        // Construct the column name based on section and score type
        $scoreColumn = $validated['section'] . '_' . $validated['scoreType'];  // e.g., 'att_1', 'ww_5'
        
        // Ensure the score column exists in the student model
        if (!Schema::hasColumn('students', $scoreColumn)) {
            return response()->json(['success' => false, 'message' => 'Invalid section or score type'], 400);
        }

        // Save the score value in the corresponding column
        $student->$scoreColumn = $validated['value'];
        $student->save();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'Score saved successfully']);
    }
}
