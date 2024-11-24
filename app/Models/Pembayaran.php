<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Relasi: Pembayaran belongs to Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman'); // Tidak perlu 'id_peminjaman' lagi
    }
    protected static function booted()
    {
        static::created(function ($pembayaran) {
            // Update status peminjaman setelah pembayaran
            $peminjaman = Peminjaman::find($pembayaran->id_peminjaman);
            if ($peminjaman) {
                $totalBayar = $peminjaman->pembayarans->sum('cicilan');
                $kekurangan = $peminjaman->jumlah_pinjaman - $totalBayar;

                if ($kekurangan <= 0) {
                    $peminjaman->status = 'lunas';
                } else {
                    $peminjaman->status = 'aktif';
                }

                $peminjaman->save();
            }
        });
    }

    // Tentukan nama tabel dan primary key yang sesuai dengan struktur database
    protected $table = 'pembayarans';
    protected $primaryKey = 'id'; // Gunakan id sebagai primary key
    public $incrementing = true;

    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = [
        'nik',
        'id_peminjaman',
        'cicilan',
        'kekurangan',
        'jumlah_pinjaman',
        'created_by',
        'role',
        'paket',
        'angsuran_ke',
    ];
}

