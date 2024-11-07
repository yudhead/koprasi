<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'nik', 'nik'); // Sesuaikan jika kolom kunci berbeda
    }
    protected $table = 'pembayarans';
    protected $primayKey = 'id_peminjaman';
    protected $fillable = [
        'nik', // Tambahkan kolom nik
        'id_peminjaman',
        'cicilan',
        'kekurangan',
        'jumlah_pinjaman', // Tambahkan kolom jumlah_pinjaman
        'created_by', // Tambahkan kolom created_by
        'role', // Tambahkan kolom role
    ];
}
