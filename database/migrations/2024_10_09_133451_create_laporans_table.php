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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('simpanan_wajib', 15, 2);
            $table->decimal('simpanan_sukarela', 15, 2);
            $table->decimal('peminjaman', 15, 2);
            $table->decimal('cicilan', 15, 2);
            $table->decimal('kekurangan', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
