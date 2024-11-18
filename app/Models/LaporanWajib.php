<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanWajib extends Model
{
    use HasFactory;
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id');
    }
    protected $fillable = [
        'id_peminjaman',
        'nik',
        'simpanan_wajib',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'created_by');
}
}
