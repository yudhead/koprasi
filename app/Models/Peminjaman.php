<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = [
        'nama',
        'nik',
        'tanggal_lahir',
        'alamat',
        'no_telp',
        'jumlah_pinjaman',
        'jumlah_angsuran',
        'unduhan_pengajuan',
        'upload_pengajuan',
    ];
}
