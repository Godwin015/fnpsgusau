<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('code', 30)->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('class_level_subject', function (Blueprint $table) {
            $table->id();

            $table->foreignId('class_level_id')
                ->constrained('class_levels')
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(
                ['class_level_id', 'subject_id'],
                'class_level_subject_unique'
            );
        });

        Schema::create('student_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('enrollment_id')
                ->constrained('enrollments')
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->restrictOnDelete();

            $table->decimal('first_assessment', 5, 2)->nullable();
            $table->decimal('second_assessment', 5, 2)->nullable();
            $table->decimal('exam', 5, 2)->nullable();

            $table->foreignId('entered_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('status', 20)->default('draft');
            $table->timestamps();

            $table->unique(
                ['enrollment_id', 'subject_id'],
                'student_results_enrollment_subject_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_results');
        Schema::dropIfExists('class_level_subject');
        Schema::dropIfExists('subjects');
    }
};

