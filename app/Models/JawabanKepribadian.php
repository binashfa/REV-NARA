<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanKepribadian extends Model
{
    protected $fillable = ['siswa_id', 'pertanyaan_kepribadian_id', 'nilai'];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanKepribadian::class, 'pertanyaan_kepribadian_id');
    }
}
