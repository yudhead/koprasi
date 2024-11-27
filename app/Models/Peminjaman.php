<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

<<<<<<< HEAD
    // Tentukan nama tabel
    protected $table = 'peminjaman';

    // Tentukan kolom primary key
    protected $primaryKey = 'id_peminjaman';

    // Jika primary key bukan auto increment, tentukan ini
    public $incrementing = true; // Atur menjadi false jika primary key tidak auto increment

    // Tentukan tipe data primary key jika bukan integer
    protected $keyType = 'int'; // Bisa 'string' jika primary key bertipe string

    // Kolom-kolom yang dapat diisi
=======
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
>>>>>>> 1eab40175923cfd3547ad0890480e0a8f9057508
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
<<<<<<< HEAD
        'ketua_status', 
        'wakil_ketua_status',
        'sekertaris_status',
        'bendahara_status',
        'pengawas_status',
=======
        'paket',
        'angsuran_ke',
        'status',
>>>>>>> 1eab40175923cfd3547ad0890480e0a8f9057508
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
