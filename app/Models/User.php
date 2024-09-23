<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
       'id', 'name', 'email', 'password', 'role_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
