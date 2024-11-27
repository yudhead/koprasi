<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'peminjaman';

    // Tentukan kolom primary key
    protected $primaryKey = 'id_peminjaman';

    // Jika primary key bukan auto increment, tentukan ini
    public $incrementing = true; // Atur menjadi false jika primary key tidak auto increment

    // Tentukan tipe data primary key jika bukan integer
    protected $keyType = 'int'; // Bisa 'string' jika primary key bertipe string

    // Kolom-kolom yang dapat diisi
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
        'ketua_status', 
        'wakil_ketua_status',
        'sekertaris_status',
        'bendahara_status',
        'pengawas_status',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
