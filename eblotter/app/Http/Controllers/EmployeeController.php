<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Grade;
use App\Models\Student; // Make sure you include the Student model
use Auth;

class EmployeeController extends Controller
{
    public function showSections()
    {
        // Fetch the sections created by the logged-in employee
        $sections = Section::where('employee_id', Auth::id())->get();

        return view('employee-sections', compact('sections'));
    }

    public function createSection(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create the new section
        Section::create([
            'name' => $request->name,
            'description' => $request->description,
            'employee_id' => auth()->id(), // Assuming employee_id is the user creating the section
        ]);

        return redirect()->route('employee.sections')->with('success', 'Section created successfully!');
    }

    // Show the grades table for a specific section
    public function showGradesTable($sectionId)
    {
        $section = Section::findOrFail($sectionId);
        $grades = Grade::where('section_id', $sectionId)->get();  // Now the Grade model is recognized
        
        return view('eTable', compact('section', 'grades'));
    }

    public function addStudentGrade(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'student_id' => 'required|integer|exists:students,id',
            'section_id' => 'required|integer|exists:sections,id',
            'attendance' => 'nullable|numeric|min:0|max:100',
            'written_work' => 'nullable|numeric|min:0|max:100',
            'performance' => 'nullable|numeric|min:0|max:100',
            'examination' => 'nullable|numeric|min:0|max:100',
        ]);

        // Save the grade in the database
        Grade::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'section_id' => $request->section_id,
            ],
            [
                'attendance' => $request->attendance,
                'written_work' => $request->written_work,
                'performance' => $request->performance,
                'examination' => $request->examination,
            ]
        );

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Student grade saved successfully!');
    }

    public function saveStudentGrade(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'student_id' => 'required|exists:students,student_id', // Validate if student exists
            'column_name' => 'required|string', // Validate column name
            'value' => 'required|numeric|min:0|max:100', // Ensure value is numeric and within range
        ]);
    
        // Find the student record by student ID
        $student = Student::where('student_id', $request->student_id)->first();
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found.']);
        }
    
        // Dynamically update the student's grade column
        $columnName = $request->column_name;
        $student->$columnName = $request->value;
        $student->save();
    
        return response()->json(['success' => true]);
    }
    

    // New index method to display all students
    public function index()
    {
        // Get all students
        $students = Student::all(); // Fetch all student records

        // Pass the students data to the view 'employee.index'
        return view('employee.index', compact('students'));
    }
}
