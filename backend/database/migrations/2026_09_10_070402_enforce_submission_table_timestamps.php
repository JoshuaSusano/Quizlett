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
        foreach (['test_cases', 'submissions', 'submissions_test_results'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->timestamp('created_at')->nullable(false)->change();
                $table->timestamp('updated_at')->nullable(false)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (['test_cases', 'submissions', 'submissions_test_results'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->timestamp('created_at')->nullable()->change();
                $table->timestamp('updated_at')->nullable()->change();
            });
        }
    }
};
