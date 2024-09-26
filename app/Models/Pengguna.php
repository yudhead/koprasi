<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna'; // Deklarasi nama tabel yang benar

    protected $fillable = [
        'nama',
        'nik',
        'tanggal_lahir',
        'alamat',
        'no_telp',
    ];
}


