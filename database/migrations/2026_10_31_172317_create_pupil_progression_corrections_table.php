<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pupil_progression_corrections', function (Blueprint $table) {
            $table->id();

            // The original progression audit record.
            $table->foreignId('pupil_progression_audit_id')
                ->constrained('pupil_progression_audits')
                ->restrictOnDelete();

            // Pupil affected by the correction.
            $table->foreignId('student_id')
                ->constrained('students')
                ->restrictOnDelete();

            // Super Admin who performed the correction.
            $table->foreignId('performed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Type of correction.
            $table->string('correction_type', 30);

            // Reason entered by the Super Admin.
            $table->text('reason');

            // Enrollment details before the correction.
            $table->json('before_snapshot');

            // Enrollment details after the correction.
            $table->json('after_snapshot');

            // Prevent correcting the same original audit twice.
            $table->unique(
                'pupil_progression_audit_id',
                'progression_correction_original_unique'
            );

            $table->index(['student_id', 'created_at']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pupil_progression_corrections');
    }
};
