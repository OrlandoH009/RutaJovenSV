<?php

use App\Models\Institution;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->after('id')->constrained('institutions')->nullOnDelete();
        });

        Institution::linkCampuses();
    }

    public function down(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('parent_id');
        });
    }
};
