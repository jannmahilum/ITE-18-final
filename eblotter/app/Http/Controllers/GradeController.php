<?php

// app/Http/Controllers/GradeController.php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'student_id' => 'required|exists:students,id',
            'attendance' => 'nullable|numeric',
            'written_work' => 'nullable|numeric',
            'performance_tasks' => 'nullable|numeric',
            'examination' => 'nullable|numeric',
            'semester_grade' => 'nullable|numeric',
        ]);

        // Create a new grade record
        Grade::create($validatedData);

        return response()->json(['message' => 'Grade saved successfully!']);
    }
}
