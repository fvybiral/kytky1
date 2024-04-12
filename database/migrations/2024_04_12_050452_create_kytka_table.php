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
        Schema::create('kytka', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('souborid');
            $table->string('input');
            $table->string('normalized_input');
            $table->string('match_score');
            $table->integer('encyklopedieid')->nullable();
            $table->string('name');
            $table->string('addition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kytka');
    }
};
