<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }

    protected $table = 'pembayarans';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = [
        'nik',
        'id_peminjaman',
        'cicilan',
        'kekurangan',
        'jumlah_pinjaman',
        'created_by',
        'role',
    ];
}
