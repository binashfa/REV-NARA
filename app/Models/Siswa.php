<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'nisn',
        'nama',
        'jenis_kelamin'
    ];

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function jawabanMinats()
    {
        return $this->hasMany(JawabanMinat::class);
    }

    public function hasilMinat()
    {
        return $this->hasOne(HasilMinat::class);
    }

    public function jawabanKepribadians()
    {
        return $this->hasMany(JawabanKepribadian::class);
    }

    public function hasilKepribadian()
    {
        return $this->hasOne(HasilKepribadian::class);
    }
}
