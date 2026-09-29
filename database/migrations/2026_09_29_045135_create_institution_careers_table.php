<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institution_careers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained('institutions')->cascadeOnDelete();
            $table->foreignId('career_id')->constrained('careers')->cascadeOnDelete();
            $table->enum('modality', ['presencial', 'virtual', 'mixta'])->default('presencial');
            $table->text('requirements')->nullable();
            $table->text('cost_info')->nullable();
            $table->timestamps();

            $table->unique(['institution_id', 'career_id', 'modality']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institution_careers');
    }
};
