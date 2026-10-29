<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('class_level_id')
                ->constrained('class_levels')
                ->restrictOnDelete();

            $table->string('name', 50);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['class_level_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};