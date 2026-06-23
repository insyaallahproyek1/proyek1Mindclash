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
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('time_limit')->default(10)->after('description'); // time limit in minutes
        });

        Schema::table('quiz_results', function (Blueprint $table) {
            $table->text('answers')->nullable()->after('score'); // stores JSON of question_id => answer
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('time_limit');
        });

        Schema::table('quiz_results', function (Blueprint $table) {
            $table->dropColumn('answers');
        });
    }
};
