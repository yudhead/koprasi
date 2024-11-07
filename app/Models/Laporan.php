<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'simpanan_wajib',
        'simpanan_sukarela',
        'peminjaman',
        'cicilan',
        'kekurangan'
    ];
    
    public function user()
{
    return $this->belongsTo(User::class, 'created_by');
}
}
