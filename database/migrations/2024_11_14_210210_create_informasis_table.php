<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('informasis', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->decimal('simpanan_wajib', 15, 2);
        $table->decimal('simpanan_sukarela', 15, 2);
        $table->decimal('simpanan_terpimpin', 15, 2);
        $table->decimal('pinjaman', 15, 2);
        $table->decimal('total', 15, 2)->nullable(); // Kolom total, diisi otomatis
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasis');
    }
};
