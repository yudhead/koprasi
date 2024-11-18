<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranSukarela extends Model
{
    use HasFactory;
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }
    protected $table = 'pembayarans_sukarela';
    protected $primayKey = 'id';
    protected $fillable = [
        'nik', // Tambahkan kolom nik
        'id_peminjaman',
        'sukarela',
        'created_by', // Tambahkan kolom created_by
        'role', // Tambahkan kolom role
    ];
}
