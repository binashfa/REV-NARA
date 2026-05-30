<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $fillable = [
        'pertanyaan',
        'kategori'
    ];

    public function jawabanMinats()
    {
        return $this->hasMany(JawabanMinat::class);
    }
}
