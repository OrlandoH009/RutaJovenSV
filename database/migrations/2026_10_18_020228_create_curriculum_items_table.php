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
        Schema::create('curriculum_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_career_id')->constrained('institution_careers')->cascadeOnDelete();
            $table->unsignedTinyInteger('cycle_number')->nullable();
            $table->string('cycle_label');
            $table->string('subject_name');
            $table->string('subject_code')->nullable();
            $table->unsignedTinyInteger('credits')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['institution_career_id', 'cycle_number', 'sort_order'], 'curriculum_items_order_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_items');
    }
};
