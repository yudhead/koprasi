<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranWajib extends Model
{
    use HasFactory;
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'nik', 'nik'); // Sesuaikan jika kolom kunci berbeda
    }
    protected $table = 'pembayarans_wajib';
    protected $primayKey = 'id';
    protected $fillable = [
        'nik', // Tambahkan kolom nik
        'id_peminjaman',
        'simpanan_wajib',
        'created_by', // Tambahkan kolom created_by
        'role', // Tambahkan kolom role
    ];
}
