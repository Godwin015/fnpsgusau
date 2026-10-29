<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_statuses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('enrollment_id')
                ->constrained('enrollments')
                ->cascadeOnDelete();

            $table->string('term', 20);
            $table->string('status', 20)->default('not_paid');

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->unique(
                ['enrollment_id', 'term'],
                'student_fee_status_enrollment_term_unique'
            );
        });

        Schema::create('class_term_publications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->restrictOnDelete();

            $table->foreignId('section_id')
                ->constrained('sections')
                ->restrictOnDelete();

            $table->string('term', 20);
            $table->boolean('is_published')->default(false);

            $table->foreignId('published_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            $table->unique(
                ['academic_session_id', 'section_id', 'term'],
                'class_term_publication_unique'
            );
        });

        Schema::create('fee_status_audits', function (Blueprint $table) {
            $table->id();

            // Nullable so the audit record can survive enrolment deletion.
            $table->foreignId('enrollment_id')
                ->nullable()
                ->constrained('enrollments')
                ->nullOnDelete();

            $table->string('term', 20);
            $table->string('old_status', 20)->nullable();
            $table->string('new_status', 20);

            $table->foreignId('changed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('note')->nullable();
            $table->timestamps();

            $table->index(
                ['enrollment_id', 'term'],
                'fee_status_audits_enrollment_term_index'
            );
        });

        Schema::create('result_publication_audits', function (Blueprint $table) {
            $table->id();

            // Nullable foreign keys preserve the audit trail if a related
            // section or academic session is later removed.
            $table->foreignId('academic_session_id')
                ->nullable()
                ->constrained('academic_sessions')
                ->nullOnDelete();

            $table->foreignId('section_id')
                ->nullable()
                ->constrained('sections')
                ->nullOnDelete();

            $table->string('term', 20);
            $table->string('action', 30);

            $table->foreignId('performed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->unsignedInteger('eligible_count')->default(0);
            $table->unsignedInteger('excluded_count')->default(0);
            $table->json('details')->nullable();

            $table->timestamps();

            $table->index(
                ['academic_session_id', 'section_id', 'term'],
                'result_publication_audits_scope_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('result_publication_audits');
        Schema::dropIfExists('fee_status_audits');
        Schema::dropIfExists('class_term_publications');
        Schema::dropIfExists('student_fee_statuses');
    }
};
