<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('problem_id')
                ->constrained('problems')
                ->cascadeOnDelete();
            $table->string('language', 50);
            $table->text('source_code');
            $table->enum('status', [
                'pending',
                'accepted',
                'wrong_answer',
                'compilation_error',
                'runtime_error',
                'time_limit_exceeded',
                'memory_limit_exceeded',
            ])->default('pending');
            $table->decimal('score', 5, 2)->default(0.00);
            $table->integer('execution_time_ms')->nullable();
            $table->integer('memory_used_kb')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['problem_id']);
            $table->dropColumn([
                'user_id',
                'problem_id',
                'language',
                'source_code',
                'status',
                'score',
                'execution_time_ms',
                'memory_used_kb',
            ]);
        });
    }
};
