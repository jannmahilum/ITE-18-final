<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'student_id',
        'attendance',
        'written_work',
        'performance_tasks',
        'examination',
        'semester_grade',
    ];
}

