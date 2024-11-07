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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); 
            $table->string('nik')->unique();
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('no_telp');
            $table->integer('jumlah_pinjaman');
            $table->integer('jumlah_angsuran');
            $table->string('unduhan_pengajuan')->nullable();
            $table->string('upload_pengajuan')->nullable();
            $table->string('role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
