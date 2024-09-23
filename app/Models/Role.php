<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const SEKERTARIS = 1;
    const ANGGOTA = 2;
    const KETUA = 3;
    const WAKIL_KETUA = 4;
    const PENGAWAS = 5;
    const BENDAHARA = 6;

    protected $fillable = ['name'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
