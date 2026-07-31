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
        Schema::create('danh_mucs', function (Blueprint $table) {
            $table->id();
            $table->string('ten', 150)->unique();
            $table->string('slug', 160)->nullable()->unique();
            $table->timestamps();
        });

        Schema::table('tin_tucs', function (Blueprint $table) {
            $table->foreignId('danh_muc_id')->nullable()->constrained('danh_mucs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tin_tucs', function (Blueprint $table) {
            $table->dropForeign(['danh_muc_id']);
            $table->dropColumn('danh_muc_id');
        });

        Schema::dropIfExists('danh_mucs');
    }
};
