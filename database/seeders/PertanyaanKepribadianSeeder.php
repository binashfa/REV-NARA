<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PertanyaanKepribadian;

class PertanyaanKepribadianSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['pertanyaan' => 'Saya suka memecahkan masalah dengan logika dan mencari tahu penyebab suatu hal.', 'kategori' => 'IPA'],
            ['pertanyaan' => 'Saya senang berdiskusi, bekerja sama, dan memahami keadaan sosial di sekitar saya.', 'kategori' => 'IPS'],
            ['pertanyaan' => 'Saya tertarik mencoba teknologi baru, komputer, atau hal yang berhubungan dengan IT.', 'kategori' => 'TKJ'],
            ['pertanyaan' => 'Saya suka menuangkan ide kreatif melalui gambar, desain, video, atau karya visual lainnya.', 'kategori' => 'DKV'],
            ['pertanyaan' => 'Saya teliti dalam menghitung, mengatur uang, atau mencatat sesuatu dengan rapi.', 'kategori' => 'Akuntansi'],
            ['pertanyaan' => 'Saya nyaman berada di lingkungan yang disiplin dan memiliki kegiatan keagamaan yang rutin.', 'kategori' => 'Pondok Pesantren'],
            ['pertanyaan' => 'Saya lebih suka pekerjaan yang membutuhkan analisis dan ketelitian dibanding hafalan.', 'kategori' => 'IPA'],
            ['pertanyaan' => 'Saya percaya diri saat menyampaikan ide atau pendapat kepada orang lain.', 'kategori' => 'IPS'],
            ['pertanyaan' => 'Saya senang membantu teman memahami pelajaran atau menyelesaikan masalah bersama.', 'kategori' => 'IPS'],
            ['pertanyaan' => 'Saya memiliki tanggung jawab dan disiplin dalam menyelesaikan tugas tepat waktu.', 'kategori' => 'Pondok Pesantren']
        ];
        foreach ($data as $item) {
            PertanyaanKepribadian::create($item);
        }
    }
}
