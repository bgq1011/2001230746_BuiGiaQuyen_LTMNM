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
    Schema::create('tin_tucs', function (Blueprint $table) {
                 $table->id();
                $table->string('tieude', 200);
                $table->string('tomtat', 300)->nullable();
                $table->text('noidung');
                $table->string('hinhanh', 100)->nullable();
                $table->datetime('ngaydang')->useCurrent();
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tin_tucs');
    }
};
