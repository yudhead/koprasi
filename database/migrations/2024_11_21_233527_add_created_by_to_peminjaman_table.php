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
        // Schema::table('peminjaman', function (Blueprint $table) {
        //     $table->unsignedBigInteger('created_by')->nullable()->after('role');
        // });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('peminjaman', function (Blueprint $table) {
        //     //
        // });
    }
};
