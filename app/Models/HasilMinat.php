<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilMinat extends Model
{
    protected $fillable = [
        'siswa_id',
        'ipa',
        'ips',
        'tkj',
        'dkv',
        'akuntansi',
        'pondok_pesantren',
        'hasil'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
