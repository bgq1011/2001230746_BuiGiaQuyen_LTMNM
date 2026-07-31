<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hinh_anh_tin_tucs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tin_id')->constrained('tin_tucs')->cascadeOnDelete();
            $table->string('duongdan', 255);
            $table->string('ghi_chu', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hinh_anh_tin_tucs');
    }
};
