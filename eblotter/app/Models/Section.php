<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    // Define the relationship with grades
    public function grades()
    {
        return $this->hasMany(Grade::class); // A section has many grades
    }

    // Optionally define the relationship with students (if you have a Student model)
    public function students()
    {
        return $this->hasMany(Student::class); // A section has many students
    }
}
