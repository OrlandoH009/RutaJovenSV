<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_route_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_route_id')->constrained('academic_routes')->cascadeOnDelete();
            $table->foreignId('career_id')->nullable()->constrained('careers')->nullOnDelete();
            $table->foreignId('institution_id')->nullable()->constrained('institutions')->nullOnDelete();
            $table->unsignedSmallInteger('position')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_route_items');
    }
};
