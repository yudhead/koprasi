<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('nik'); // NIK dari peminjam
            $table->decimal('simpanan_wajib', 15, 2);
            $table->decimal('simpanan_sukarela', 15, 2)->nullable(); // Boleh null
            $table->decimal('cicilan', 15, 2);
            $table->decimal('kekurangan', 15, 2);
            $table->decimal('jumlah_pinjaman', 15, 2); // Jumlah pinjaman dari tabel peminjaman
            $table->unsignedBigInteger('created_by'); // ID user yang membuat pembayaran
            $table->string('role'); // Role user yang menginput
            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
