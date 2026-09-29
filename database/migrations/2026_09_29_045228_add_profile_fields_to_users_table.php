<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('department')->nullable()->after('email');
            $table->string('municipality')->nullable()->after('department');
            $table->string('academic_level')->nullable()->after('municipality');
            $table->string('bachillerato_type')->nullable()->after('academic_level');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['department', 'municipality', 'academic_level', 'bachillerato_type']);
        });
    }
};
