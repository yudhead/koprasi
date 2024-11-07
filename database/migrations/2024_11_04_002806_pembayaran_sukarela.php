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
        Schema::create('pembayarans_sukarela', function (Blueprint $table) {
            $table->id();
            $table->string('nik'); // NIK dari peminjam
            $table->decimal('sukarela', 15, 2);
            $table->unsignedBigInteger('created_by'); // ID user yang membuat pembayaran
            $table->string('role'); // Role user yang menginput
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans_sukarela');
    }
};
