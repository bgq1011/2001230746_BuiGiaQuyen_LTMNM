<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tin_tucs', function (Blueprint $table) {
            if (!Schema::hasColumn('tin_tucs', 'hinhanh_path')) {
                $table->string('hinhanh_path', 255)->nullable()->after('hinhanh');
            }
            if (!Schema::hasColumn('tin_tucs', 'danhmuc_id')) {
                $table->foreignId('danhmuc_id')->nullable()->constrained('danh_mucs')->nullOnDelete();
            }
            if (!Schema::hasColumn('tin_tucs', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tin_tucs', function (Blueprint $table) {
            if (Schema::hasColumn('tin_tucs', 'hinhanh_path')) $table->dropColumn('hinhanh_path');
            if (Schema::hasColumn('tin_tucs', 'danhmuc_id')) $table->dropConstrainedForeignId('danhmuc_id');
            if (Schema::hasColumn('tin_tucs', 'deleted_at')) $table->dropSoftDeletes();
        });
    }
};
