<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanMinat extends Model
{
    protected $fillable = [
        'siswa_id',
        'pertanyaan_id',
        'nilai'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }
}
