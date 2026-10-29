<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->restrictOnDelete();

            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->restrictOnDelete();

            $table->foreignId('section_id')
                ->constrained('sections')
                ->restrictOnDelete();

            $table->string('promotion_status', 30)
                ->default('pending');

            $table->string('enrollment_status', 30)
                ->default('enrolled');

            $table->timestamps();

            $table->unique(
                ['student_id', 'academic_session_id'],
                'enrollments_student_session_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};