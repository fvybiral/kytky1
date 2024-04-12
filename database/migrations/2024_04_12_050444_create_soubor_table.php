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
        Schema::create('soubor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('storage_path');
            $table->string('state')->default('NEW');
            $table->integer('lines_count')->nullable();
            $table->float('progress')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soubor');
    }
};
