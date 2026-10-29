<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_section_assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('section_id')
                ->constrained('sections')
                ->cascadeOnDelete();

            $table->foreignId('assigned_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->unique(
                ['user_id', 'section_id'],
                'staff_section_assignments_user_section_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_section_assignments');
    }
};

