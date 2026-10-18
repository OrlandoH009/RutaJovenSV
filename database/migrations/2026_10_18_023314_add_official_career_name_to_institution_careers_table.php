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
        Schema::table('institution_careers', function (Blueprint $table) {
            $table->string('official_career_name')->nullable()->after('career_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('institution_careers', function (Blueprint $table) {
            $table->dropColumn('official_career_name');
        });
    }
};
