<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Daftar konstanta role
    const SEKERTARIS = 1;
    const ANGGOTA = 2;
    const KETUA = 3;
    const WAKIL_KETUA = 4;
    const PENGAWAS = 5;
    const BENDAHARA = 6;

    

    // Mass assignment untuk kolom 'name'
    protected $fillable = ['name'];

    // Nonaktifkan timestamps
    public $timestamps = false;

    // Relasi dengan tabel users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Helper untuk mendapatkan nama role berdasarkan ID
    public static function getRoleName($roleId)
    {
        $roles = [
            self::SEKERTARIS => 'Sekertaris',
            self::ANGGOTA => 'Anggota',
            self::KETUA => 'Ketua',
            self::WAKIL_KETUA => 'Wakil Ketua',
            self::PENGAWAS => 'Pengawas',
            self::BENDAHARA => 'Bendahara',
        ];

        return strtoupper($roles[$roleId] ?? 'Unknown'); // Ubah ke huruf besar, default "Unknown" jika tidak ditemukan
    }

    // Helper untuk mendapatkan semua konstanta role
    public static function getRoleConstants()
    {
        return [
            'ketua' => self::KETUA,
            'wakil_ketua' => self::WAKIL_KETUA,
            'sekertaris' => self::SEKERTARIS,
            'bendahara' => self::BENDAHARA,
            'pengawas' => self::PENGAWAS,
        ];
    }
}
