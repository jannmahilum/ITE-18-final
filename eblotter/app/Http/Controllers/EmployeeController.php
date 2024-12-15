<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Grade;

class EmployeeController extends Controller
{
    // Show all employee sections
    public function showSections()
    {
        $sections = Section::where('employee_id', auth()->id())->get(); 
        
        if ($sections->isEmpty()) {
            session()->flash('error', 'No sections found.');
            return view('employee-sections', ['sections' => []]);
        }
        
        return view('employee-sections', compact('sections'));
    }

    // Show section details
    public function showSectionDetails($section)
    {
        $sectionDetails = Section::with(['students', 'grades'])->find($section);

        if (!$sectionDetails) {
            return abort(404, 'Section not found');
        }

        return view('eTable', [
            'sectionDetails' => $sectionDetails,
            'students' => $sectionDetails->students,
            'grades' => $sectionDetails->grades,
        ]);
    }

    // Create a new section
    public function createSection(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        // Create the section and associate it with the authenticated employee
        $section = Section::create([
            'name' => $request->name,
            'description' => $request->description,
            'employee_id' => auth()->id(),
        ]);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'section' => $section,
            'student_count' => $section->students->count(), // Assumes a 'students' relationship exists
        ]);
    }
}
