<?php

namespace App\Models\SecurityReport\Vulnerable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


//kode yang salah
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * fild yang boleh diisi
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**field yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * konversi tipe data
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
}