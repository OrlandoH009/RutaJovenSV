<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_interest_weights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained('careers')->cascadeOnDelete();
            $table->string('interest_key');
            $table->unsignedTinyInteger('weight');
            $table->timestamps();

            $table->unique(['career_id', 'interest_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_interest_weights');
    }
};
