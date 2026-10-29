<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('student_results', 'term')) {
            Schema::table('student_results', function (Blueprint $table) {
                $table->string('term', 20)
                    ->default('First Term');
            });
        }

        // Preserve existing results as First Term.
        DB::table('student_results')
            ->whereNull('term')
            ->update(['term' => 'First Term']);

        // Use Laravel's database-compatible schema inspection.
        $indexes = collect(
            Schema::getIndexes('student_results')
        )->pluck('name');

        // Add the replacement index before dropping the old one.
        if (! $indexes->contains(
            'student_results_enrollment_subject_term_unique'
        )) {
            Schema::table('student_results', function (Blueprint $table) {
                $table->unique(
                    ['enrollment_id', 'subject_id', 'term'],
                    'student_results_enrollment_subject_term_unique'
                );
            });
        }

        // Drop the old index only after the replacement exists.
        if ($indexes->contains(
            'student_results_enrollment_subject_unique'
        )) {
            Schema::table('student_results', function (Blueprint $table) {
                $table->dropUnique(
                    'student_results_enrollment_subject_unique'
                );
            });
        }
    }

    public function down(): void
    {
        // Intentionally retain the term column and indexes.
        // Removing them could compromise term-specific results.
    }
};
