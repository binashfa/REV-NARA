<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    public function operator()
    {
        return $this->hasOne(Operator::class);
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}