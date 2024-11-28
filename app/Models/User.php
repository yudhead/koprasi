<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users'; // Pastikan nama tabel sudah sesuai
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    // Relasi ke tabel roles
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi ke pembuat data
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
