<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    // Define the relationship with section
    public function section()
    {
        return $this->belongsTo(Section::class);  // A grade belongs to one section
    }

    // Optionally define the relationship with a student (if you have a Student model)
    public function student()
    {
        return $this->belongsTo(Student::class);  // A grade belongs to one student
    }

    // Optionally, define the fillable fields for mass assignment
    // protected $fillable = ['section_id', 'student_id', 'grade'];
}
