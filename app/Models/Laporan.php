<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }
    protected $fillable = [
        'id_peminjaman',
        'peminjaman',
        'cicilan',
        'kekurangan'
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'created_by');
}
}
