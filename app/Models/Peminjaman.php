<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}
    use HasFactory;
    protected $table = 'peminjaman';
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
    ];
}
