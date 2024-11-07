<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->string('ketua_status')->nullable();
            $table->string('wakil_ketua_status')->nullable();
            $table->string('sekertaris_status')->nullable();
            $table->string('bendahara_status')->nullable();
            $table->string('pengawas_status')->nullable();
        });
    }

    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn([
                'ketua_status',
                'wakil_ketua_status',
                'sekertaris_status',
                'bendahara_status',
                'pengawas_status',
            ]);
        });
    }

};
