<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Define the relationship to Grade
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}

