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
        Schema::table('problems', function (Blueprint $table) {
            $table->foreignId('creator_id')
                ->constrained('users')
                ->restrictOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('language', 50);
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->text('input_description')->nullable();
            $table->text('output_description')->nullable();
            $table->text('constraints')->nullable();
            $table->text('starter_code')->nullable();
            $table->text('example_input')->nullable();
            $table->text('example_output')->nullable();
            $table->integer('time_limit_ms')->default(2000);
            $table->integer('memory_limit_kb')->default(65536);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('problems', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);
            $table->dropColumn([
                'creator_id',
                'title',
                'description',
                'language',
                'difficulty',
                'input_description',
                'output_description',
                'constraints',
                'starter_code',
                'example_input',
                'example_output',
                'time_limit_ms',
                'memory_limit_kb',
            ]);
        });
    }
};
