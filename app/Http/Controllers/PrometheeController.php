<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;


class PrometheeController extends Controller
{
    public function promethee(Request $request)
    {
        $siswas = Siswa::all();

        $siswaId = $request->siswa_id;

        $siswa = null;

        $alternatif = [];

        $preferensi = [];

        $ranking = [];

        $leavingFlows = [];

        $enteringFlows = [];

        $netFlows = [];

        $akademikJurusan = [];

        $nilaiAkademikJurusan = [];

        $rataAkademik = 0;

        $mapelTerbaik = '-';

        $nilaiMapelTerbaik = 0;

        $nilaiPerMapel = [];

        $hasilMinat = '-';

        $hasilKepribadian = '-';

        $rekomendasiJurusan = null;

        if ($siswaId) {

            $siswa = Siswa::with([
                'nilais.mapel',
                'hasilMinat',
                'hasilKepribadian'
            ])->findOrFail($siswaId);

            // ==========================
            // AMBIL NILAI MAPEL
            // ==========================

            $mapel = [];

            foreach ($siswa->nilais as $nilai) {

                $namaMapel = strtoupper(
                    trim($nilai->mapel->nama_mapel)
                );

                $mapel[$namaMapel] = (
                    ($nilai->uts ?? 0) +
                    ($nilai->uas ?? 0) +
                    ($nilai->uam ?? 0)
                ) / 3;
            }

            if (!empty($mapel)) {

                $nilaiMapelTerbaik = max($mapel);

                $mapelTerbaik = array_search(
                    $nilaiMapelTerbaik,
                    $mapel
                );
            }

            foreach ($siswa->nilais as $nilai) {

                $nilaiMapel = (
                    ($nilai->uts ?? 0) +
                    ($nilai->uas ?? 0) +
                    ($nilai->uam ?? 0)
                ) / 3;

                $nilaiPerMapel[] = [
                    'mapel' => $nilai->mapel->nama_mapel,
                    'uts'   => $nilai->uts,
                    'uas'   => $nilai->uas,
                    'uam'   => $nilai->uam,
                    'nilai' => $nilaiMapel,
                ];
            }

            // ==========================
            // RATA-RATA AKADEMIK UMUM
            // ==========================

            $rataAkademik = $siswa->nilais->avg(function ($nilai) {

                return (
                    ($nilai->uts ?? 0) +
                    ($nilai->uas ?? 0) +
                    ($nilai->uam ?? 0)
                ) / 3;
            });

            // ==========================
            // AKADEMIK PER JURUSAN
            // ==========================

            $nilaiAkademikJurusan = [

                'IPA' => (
                    ($mapel['MATEMATIKA'] ?? 0) +
                    ($mapel['IPA'] ?? 0) +
                    ($mapel['BAHASA INDONESIA'] ?? 0)
                ) / 3,

                'IPS' => (
                    ($mapel['IPS'] ?? 0) +
                    ($mapel['PPKN'] ?? 0) +
                    ($mapel['BAHASA INGGRIS'] ?? 0)
                ) / 3,

                'TKJ' => (
                    ($mapel['TIK'] ?? 0) +
                    ($mapel['MATEMATIKA'] ?? 0) +
                    ($mapel['BAHASA INGGRIS'] ?? 0)
                ) / 3,

                'DKV' => (
                    ($mapel['SENI BUDAYA'] ?? 0) +
                    ($mapel['MATEMATIKA'] ?? 0) +
                    ($mapel['BAHASA INDONESIA'] ?? 0)
                ) / 3,

                'AKUNTANSI' => (
                    ($mapel['MATEMATIKA'] ?? 0) +
                    ($mapel['BAHASA INDONESIA'] ?? 0) +
                    ($mapel['BAHASA INGGRIS'] ?? 0)
                ) / 3,

                'PONPES' => (
                    ($mapel['BAHASA ARAB'] ?? 0) +
                    ($mapel['BTQ'] ?? 0) +
                    ($mapel['BAHASA INDONESIA'] ?? 0)
                ) / 3,
            ];

            $akademikJurusan = $nilaiAkademikJurusan;

            // ==========================
            // KONVERSI AKADEMIK (C1)
            // ==========================

            foreach ($akademikJurusan as $jurusan => $nilai) {

                if ($nilai >= 90) {

                    $akademikJurusan[$jurusan] = 5;
                } elseif ($nilai >= 85) {

                    $akademikJurusan[$jurusan] = 4;
                } elseif ($nilai >= 80) {

                    $akademikJurusan[$jurusan] = 3;
                } elseif ($nilai >= 75) {

                    $akademikJurusan[$jurusan] = 2;
                } else {

                    $akademikJurusan[$jurusan] = 1;
                }
            }

            // ==========================
            // HASIL DOMINAN
            // ==========================

            $hasilMinat =
                $siswa->hasilMinat->hasil ?? '-';

            $hasilKepribadian =
                $siswa->hasilKepribadian->hasil ?? '-';

            // ==========================
            // ALTERNATIF
            // ==========================

            $alternatif = [

                'IPA' => [
                    'akademik' => $nilaiAkademikJurusan['IPA'],
                    'minat' => $siswa->hasilMinat->ipa ?? 0,
                    'kepribadian' => $siswa->hasilKepribadian->ipa ?? 0
                ],

                'IPS' => [
                    'akademik' => $nilaiAkademikJurusan['IPS'],
                    'minat' => $siswa->hasilMinat->ips ?? 0,
                    'kepribadian' => $siswa->hasilKepribadian->ips ?? 0
                ],

                'TKJ' => [
                    'akademik' => $nilaiAkademikJurusan['TKJ'],
                    'minat' => $siswa->hasilMinat->tkj ?? 0,
                    'kepribadian' => $siswa->hasilKepribadian->tkj ?? 0
                ],

                'DKV' => [
                    'akademik' => $nilaiAkademikJurusan['DKV'],
                    'minat' => $siswa->hasilMinat->dkv ?? 0,
                    'kepribadian' => $siswa->hasilKepribadian->dkv ?? 0
                ],

                'AKUNTANSI' => [
                    'akademik' => $nilaiAkademikJurusan['AKUNTANSI'],
                    'minat' => $siswa->hasilMinat->akuntansi ?? 0,
                    'kepribadian' => $siswa->hasilKepribadian->akuntansi ?? 0
                ],

                'PONPES' => [
                    'akademik' => $nilaiAkademikJurusan['PONPES'],
                    'minat' => $siswa->hasilMinat->pondok_pesantren ?? 0,
                    'kepribadian' => $siswa->hasilKepribadian->pondok_pesantren ?? 0
                ]
            ];

            // ==========================
            // KONVERSI MINAT (C2)
            // ==========================

            foreach ($alternatif as $jurusan => $nilai) {

                $m = $nilai['minat'];

                if ($m >= 7) {

                    $alternatif[$jurusan]['minat'] = 5;
                } elseif ($m == 6) {

                    $alternatif[$jurusan]['minat'] = 4;
                } elseif ($m == 5) {

                    $alternatif[$jurusan]['minat'] = 3;
                } elseif ($m == 4) {

                    $alternatif[$jurusan]['minat'] = 2;
                } else {

                    $alternatif[$jurusan]['minat'] = 1;
                }
            }

            // ==========================
            // KONVERSI KEPRIBADIAN (C3)
            // ==========================

            foreach ($alternatif as $jurusan => $nilai) {

                $k = $nilai['kepribadian'];

                if ($k >= 3.5) {

                    $alternatif[$jurusan]['kepribadian'] = 5;
                } elseif ($k >= 3.0) {

                    $alternatif[$jurusan]['kepribadian'] = 4;
                } elseif ($k >= 2.5) {

                    $alternatif[$jurusan]['kepribadian'] = 3;
                } elseif ($k >= 2.0) {

                    $alternatif[$jurusan]['kepribadian'] = 2;
                } else {

                    $alternatif[$jurusan]['kepribadian'] = 1;
                }
            }

            // ==========================
            // PREFERENSI π(a,b)
            // ==========================

            foreach ($alternatif as $a => $nilaiA) {

                foreach ($alternatif as $b => $nilaiB) {

                    if ($a == $b) {

                        $preferensi[$a][$b] = 0;

                        continue;
                    }

                    $p1 =
                        ($nilaiA['akademik'] - $nilaiB['akademik']) > 0
                        ? 1 : 0;

                    $p2 =
                        ($nilaiA['minat'] - $nilaiB['minat']) > 0
                        ? 1 : 0;

                    $p3 =
                        ($nilaiA['kepribadian'] - $nilaiB['kepribadian']) > 0
                        ? 1 : 0;

                    $preferensi[$a][$b] =
                        ($p1 + $p2 + $p3) / 3;
                }
            }

            // ==========================
            // LEAVING FLOW
            // ==========================

            foreach ($preferensi as $a => $row) {

                $leavingFlows[$a] =
                    array_sum($row) /
                    (count($alternatif) - 1);
            }

            // ==========================
            // ENTERING FLOW
            // ==========================

            foreach ($alternatif as $a => $v) {

                $jumlah = 0;

                foreach ($preferensi as $row) {

                    $jumlah += $row[$a];
                }

                $enteringFlows[$a] =
                    $jumlah /
                    (count($alternatif) - 1);
            }

            // ==========================
            // NET FLOW
            // ==========================

            foreach ($alternatif as $a => $v) {

                $netFlows[$a] =
                    $leavingFlows[$a]
                    -
                    $enteringFlows[$a];
            }

            // ==========================
            // RANKING
            // ==========================

            $ranking = $netFlows;

            arsort($ranking);

            $rekomendasiJurusan =
                array_key_first($ranking);
        }

        return view(
            'guru.promethee',
            compact(
                'siswas',
                'siswa',
                'siswaId',
                'alternatif',
                'preferensi',
                'ranking',
                'leavingFlows',
                'enteringFlows',
                'netFlows',
                'rataAkademik',
                'hasilMinat',
                'hasilKepribadian',
                'nilaiAkademikJurusan',
                'nilaiPerMapel',
                'akademikJurusan',
                'rekomendasiJurusan',
                'mapelTerbaik',
                'nilaiMapelTerbaik'
            )
        );
    }
}