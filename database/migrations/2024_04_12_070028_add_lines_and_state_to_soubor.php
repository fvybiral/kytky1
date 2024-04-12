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
        Schema::table('soubor', function (Blueprint $table) {
            $table->integer('lines_count')->nullable();
            $table->float('progress')->nullable();
            $table->string('state')->default('NEW');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soubor', function (Blueprint $table) {
            $table->dropColumn('lines_count');
            $table->dropColumn('state');
            $table->dropColumn('progress');
        });
    }
};
