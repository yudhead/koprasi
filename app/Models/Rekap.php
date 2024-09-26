<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    protected $table = 'rekap'; // Deklarasi nama tabel yang benar

    protected $fillable = [
        'tanggal',
        'simpanan_wajib',
        'simpanan_sukarela',
        'pinjaman',
        'total',
    ];
}
