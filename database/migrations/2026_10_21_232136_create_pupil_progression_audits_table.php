<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pupil_progression_audits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->restrictOnDelete();

            $table->foreignId('source_enrollment_id')
                ->nullable()
                ->constrained('enrollments')
                ->nullOnDelete();

            $table->foreignId('destination_enrollment_id')
                ->nullable()
                ->constrained('enrollments')
                ->nullOnDelete();

            $table->foreignId('source_session_id')
                ->nullable()
                ->constrained('academic_sessions')
                ->nullOnDelete();

            $table->foreignId('destination_session_id')
                ->nullable()
                ->constrained('academic_sessions')
                ->nullOnDelete();

            $table->foreignId('source_section_id')
                ->nullable()
                ->constrained('sections')
                ->nullOnDelete();

            $table->foreignId('destination_section_id')
                ->nullable()
                ->constrained('sections')
                ->nullOnDelete();

            $table->string('action', 30);
            $table->text('note')->nullable();

            $table->foreignId('performed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['student_id', 'created_at']);
            $table->index(['action', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pupil_progression_audits');
    }
};
