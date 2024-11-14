<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'simpanan_wajib',
        'simpanan_sukarela',
        'simpanan_terpimpin',
        'pinjaman',
        'total'
    ];

    // Set total attribute
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total = $model->simpanan_wajib + $model->simpanan_sukarela + $model->simpanan_terpimpin + $model->pinjaman;
        });
    }
}
