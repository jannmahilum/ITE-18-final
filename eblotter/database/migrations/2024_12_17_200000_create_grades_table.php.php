<?php

// Example: 2024_12_17_200000_create_grades_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('attendance_highest')->nullable();
            $table->string('written_work_highest')->nullable();
            $table->string('performance_tasks_highest')->nullable();
            $table->string('examination_highest')->nullable();
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
