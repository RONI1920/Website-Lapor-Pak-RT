<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // <--- 1. PASTIKAN ADA INI

class User extends Authenticatable
{
    use HasFactory, Notifiable; // <--- 2. PASTIKAN ADA INI

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'usertype',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
