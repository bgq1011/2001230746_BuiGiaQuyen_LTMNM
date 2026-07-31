<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tin_tucs', function (Blueprint $table) {
            if (!Schema::hasColumn('tin_tucs', 'trang_thai')) {
                $table->enum('trang_thai', ['draft', 'published'])->default('draft');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tin_tucs', function (Blueprint $table) {
            if (Schema::hasColumn('tin_tucs', 'trang_thai')) {
                $table->dropColumn('trang_thai');
            }
        });
    }
};
