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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_telp');
            $table->decimal('jumlah_pinjaman', 15, 2);
            $table->decimal('jumlah_angsuran', 15, 2);
            $table->decimal('simpanan_wajib', 15, 2);
            $table->decimal('simpanan_sukarela', 15, 2);
            $table->decimal('pinjaman', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
