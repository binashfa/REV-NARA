<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pertanyaan;

class PertanyaanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['pertanyaan' => 'Saya senang melakukan percobaan, penelitian, atau mempelajari ilmu alam dan teknologi.', 'kategori' => 'IPA'],
            ['pertanyaan' => 'Saya tertarik mempelajari ekonomi, sejarah, geografi, atau kehidupan sosial masyarakat.', 'kategori' => 'IPS'],
            ['pertanyaan' => 'Saya suka memperbaiki komputer, membuat program, atau mempelajari jaringan internet.', 'kategori' => 'TKJ'],
            ['pertanyaan' => 'Saya senang menggambar, mendesain poster, mengedit video, atau membuat karya visual.', 'kategori' => 'DKV'],
            ['pertanyaan' => 'Saya tertarik menghitung keuangan, membuat laporan, dan mengatur pemasukan serta pengeluaran.', 'kategori' => 'Akuntansi'],
            ['pertanyaan' => 'Saya senang mempelajari agama secara mendalam dan mengikuti kegiatan keagamaan.', 'kategori' => 'Pondok Pesantren'],
            ['pertanyaan' => 'Saya lebih mudah memahami pelajaran yang berhubungan dengan logika dan analisis.', 'kategori' => 'IPA'],
            ['pertanyaan' => 'Saya suka bekerja secara kreatif dan menuangkan ide dalam bentuk karya.', 'kategori' => 'DKV'],
            ['pertanyaan' => 'Saya merasa nyaman bekerja dengan data, angka, dan pencatatan yang rapi.', 'kategori' => 'Akuntansi'],
            ['pertanyaan' => 'Saya ingin berada di lingkungan pendidikan yang disiplin serta memiliki kegiatan keagamaan yang kuat.', 'kategori' => 'Pondok Pesantren']
        ];
        foreach ($data as $item) {
            Pertanyaan::create($item);
        }
    }
}
