<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('type', 20)->default('otro');
            $table->date('starts_on');
            $table->date('ends_on')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();

            $table->index('starts_on');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_events');
    }
};
