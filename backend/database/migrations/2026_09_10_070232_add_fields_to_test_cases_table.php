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
        Schema::table('test_cases', function (Blueprint $table) {
            $table->foreignId('problem_id')
                ->constrained('problems')
                ->cascadeOnDelete();
            $table->text('input');
            $table->text('expected_output');
            $table->boolean('is_hidden')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_cases', function (Blueprint $table) {
            $table->dropForeign(['problem_id']);
            $table->dropColumn(['problem_id', 'input', 'expected_output', 'is_hidden']);
        });
    }
};
