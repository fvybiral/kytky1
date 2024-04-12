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
            $table->string('input');
            $table->string('normalized_input'); // slug, serazeny abecedne
            $table->string('name')->nullable();
            $table->string('addition')->nullable();
            $table->timestamps();
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
