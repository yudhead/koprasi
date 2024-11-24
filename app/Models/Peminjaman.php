<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_peminjaman'; // Tentukan primary key jika bukan 'id'

    // Relasi: Peminjaman belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Peminjaman has many Pembayaran
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'id_peminjaman', 'id_peminjaman');
    }

    protected $table = 'peminjaman';  // Pastikan nama tabel sesuai dengan tabel di database
    protected $fillable = [
        'id_peminjaman',
        'nama',
        'nik',
        'tanggal_lahir',
        'alamat',
        'no_telp',
        'jumlah_pinjaman',
        'jumlah_angsuran',
        'unduhan_pengajuan',
        'upload_pengajuan',
        'paket',
        'angsuran_ke',
        'status',
    ];
}
