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
        Schema::create('encyklopedie', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nomenklaturaid')->nullable();
            $table->string('input');
            $table->string('normalized_input');
            $table->string('name')->nullable();
            $table->string('addition')->nullable();
            $table->timestamps();
            $table->unique(['input']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encyklopedie');
    }
};
