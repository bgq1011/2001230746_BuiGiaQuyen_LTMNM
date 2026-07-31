<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tin_tucs', function (Blueprint $table) {
            if (!Schema::hasColumn('tin_tucs', 'slug')) {
                $table->string('slug', 255)->nullable()->unique()->after('tieude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tin_tucs', function (Blueprint $table) {
            if (Schema::hasColumn('tin_tucs', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};
