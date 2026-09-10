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
        Schema::table('submissions_test_results', function (Blueprint $table) {
            $table->foreignId('submission_id')
                ->constrained('submissions')
                ->cascadeOnDelete();
            $table->foreignId('test_case_id')
                ->constrained('test_cases')
                ->cascadeOnDelete();
            $table->boolean('passed')->default(false);
            $table->text('actual_output')->nullable();
            $table->integer('execution_time_ms')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions_test_results', function (Blueprint $table) {
            $table->dropForeign(['submission_id']);
            $table->dropForeign(['test_case_id']);
            $table->dropColumn([
                'submission_id',
                'test_case_id',
                'passed',
                'actual_output',
                'execution_time_ms',
            ]);
        });
    }
};
