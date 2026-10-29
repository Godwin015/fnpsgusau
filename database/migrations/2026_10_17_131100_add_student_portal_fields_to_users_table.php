<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('login_id', 100)->nullable()->unique();
            $table->foreignId('student_id')
                ->nullable()
                ->unique()
                ->constrained('students')
                ->restrictOnDelete();
            $table->boolean('must_change_pin')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropUnique(['login_id']);
            $table->dropUnique(['student_id']);
            $table->dropColumn([
                'login_id',
                'student_id',
                'must_change_pin',
            ]);
        });
    }
};
