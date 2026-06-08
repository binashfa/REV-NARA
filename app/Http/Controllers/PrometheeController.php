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

                $mapel[$nilai->mapel_id] = (
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
                    ($mapel[5] ?? 0) + // MATEMATIKA
                    ($mapel[1] ?? 0) + // IPA
                    ($mapel[3] ?? 0)   // BAHASA INDONESIA
                ) / 3,

                'IPS' => (
                    ($mapel[2] ?? 0) + // IPS
                    ($mapel[7] ?? 0) + // PPKN
                    ($mapel[4] ?? 0)   // BAHASA INGGRIS
                ) / 3,

                'TKJ' => (
                    ($mapel[9] ?? 0) + // TIK
                    ($mapel[5] ?? 0) + // MATEMATIKA
                    ($mapel[4] ?? 0)   // BAHASA INGGRIS
                ) / 3,

                'DKV' => (
                    ($mapel[8] ?? 0) + // SENI BUDAYA
                    ($mapel[5] ?? 0) + // MATEMATIKA
                    ($mapel[3] ?? 0)   // BAHASA INDONESIA
                ) / 3,

                'AKUNTANSI' => (
                    ($mapel[5] ?? 0) + // MATEMATIKA
                    ($mapel[3] ?? 0) + // BAHASA INDONESIA
                    ($mapel[4] ?? 0)   // BAHASA INGGRIS
                ) / 3,

                'PONPES' => (
                    ($mapel[6] ?? 0) + // BAHASA ARAB
                    ($mapel[10] ?? 0) + // BTQ
                    ($mapel[3] ?? 0)    // BAHASA INDONESIA
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
                    'akademik' => $akademikJurusan['IPA'],
                    'minat' => $siswa->hasilMinat->ipa ?? 0,
                    'kepribadian' => $siswa->hasilKepribadian->ipa ?? 0
                ],

                'IPS' => [
                    'akademik' => $akademikJurusan['IPS'],
                    'minat' => $siswa->hasilMinat->ips ?? 0,
                    'kepribadian' => $siswa->hasilKepribadian->ips ?? 0
                ],

                'TKJ' => [
                    'akademik' => $akademikJurusan['TKJ'],
                    'minat' => $siswa->hasilMinat->tkj ?? 0,
                    'kepribadian' => $siswa->hasilKepribadian->tkj ?? 0
                ],

                'DKV' => [
                    'akademik' => $akademikJurusan['DKV'],
                    'minat' => $siswa->hasilMinat->dkv ?? 0,
                    'kepribadian' => $siswa->hasilKepribadian->dkv ?? 0
                ],

                'AKUNTANSI' => [
                    'akademik' => $akademikJurusan['AKUNTANSI'],
                    'minat' => $siswa->hasilMinat->akuntansi ?? 0,
                    'kepribadian' => $siswa->hasilKepribadian->akuntansi ?? 0
                ],

                'PONPES' => [
                    'akademik' => $akademikJurusan['PONPES'],
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

            $preferensi = [];

            $kriteria = ['akademik', 'minat', 'kepribadian'];

            foreach ($alternatif as $a => $nilaiA) {

                foreach ($alternatif as $b => $nilaiB) {

                    // diagonal matriks
                    if ($a === $b) {
                        $preferensi[$a][$b] = 0;
                        continue;
                    }

                    $totalPreferensi = 0;

                    $detail = [];

                    foreach ($kriteria as $k) {

                        // h(a,b)
                        $h = $nilaiA[$k] - $nilaiB[$k];

                        // fungsi preferensi tipe usual
                        $p = ($h > 0) ? 1 : 0;

                        $detail[$k] = [
                            'nilaiA' => $nilaiA[$k],
                            'nilaiB' => $nilaiB[$k],
                            'h'      => $h,
                            'p'      => $p
                        ];

                        $totalPreferensi += $p;
                    }

                    // π(a,b)
                    $preferensi[$a][$b] = round(
                        $totalPreferensi / count($kriteria),
                        2
                    );
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

    public static function getHasilPromethee($siswa)
    {

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

        
        // ==========================
        // AMBIL NILAI MAPEL
        // ==========================

        $mapel = [];

        foreach ($siswa->nilais as $nilai) {

            $mapel[$nilai->mapel_id] = (
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
                ($mapel[5] ?? 0) + // MATEMATIKA
                ($mapel[1] ?? 0) + // IPA
                ($mapel[3] ?? 0)   // BAHASA INDONESIA
            ) / 3,

            'IPS' => (
                ($mapel[2] ?? 0) + // IPS
                ($mapel[7] ?? 0) + // PPKN
                ($mapel[4] ?? 0)   // BAHASA INGGRIS
            ) / 3,

            'TKJ' => (
                ($mapel[9] ?? 0) + // TIK
                ($mapel[5] ?? 0) + // MATEMATIKA
                ($mapel[4] ?? 0)   // BAHASA INGGRIS
            ) / 3,

            'DKV' => (
                ($mapel[8] ?? 0) + // SENI BUDAYA
                ($mapel[5] ?? 0) + // MATEMATIKA
                ($mapel[3] ?? 0)   // BAHASA INDONESIA
            ) / 3,

            'AKUNTANSI' => (
                ($mapel[5] ?? 0) + // MATEMATIKA
                ($mapel[3] ?? 0) + // BAHASA INDONESIA
                ($mapel[4] ?? 0)   // BAHASA INGGRIS
            ) / 3,

            'PONPES' => (
                ($mapel[6] ?? 0) + // BAHASA ARAB
                ($mapel[10] ?? 0) + // BTQ
                ($mapel[3] ?? 0)    // BAHASA INDONESIA
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
                'akademik' => $akademikJurusan['IPA'],
                'minat' => $siswa->hasilMinat->ipa ?? 0,
                'kepribadian' => $siswa->hasilKepribadian->ipa ?? 0
            ],

            'IPS' => [
                'akademik' => $akademikJurusan['IPS'],
                'minat' => $siswa->hasilMinat->ips ?? 0,
                'kepribadian' => $siswa->hasilKepribadian->ips ?? 0
            ],

            'TKJ' => [
                'akademik' => $akademikJurusan['TKJ'],
                'minat' => $siswa->hasilMinat->tkj ?? 0,
                'kepribadian' => $siswa->hasilKepribadian->tkj ?? 0
            ],

            'DKV' => [
                'akademik' => $akademikJurusan['DKV'],
                'minat' => $siswa->hasilMinat->dkv ?? 0,
                'kepribadian' => $siswa->hasilKepribadian->dkv ?? 0
            ],

            'AKUNTANSI' => [
                'akademik' => $akademikJurusan['AKUNTANSI'],
                'minat' => $siswa->hasilMinat->akuntansi ?? 0,
                'kepribadian' => $siswa->hasilKepribadian->akuntansi ?? 0
            ],

            'PONPES' => [
                'akademik' => $akademikJurusan['PONPES'],
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

        $preferensi = [];

        $kriteria = ['akademik', 'minat', 'kepribadian'];

        foreach ($alternatif as $a => $nilaiA) {

            foreach ($alternatif as $b => $nilaiB) {

                // diagonal matriks
                if ($a === $b) {
                    $preferensi[$a][$b] = 0;
                    continue;
                }

                $totalPreferensi = 0;

                $detail = [];

                foreach ($kriteria as $k) {

                    // h(a,b)
                    $h = $nilaiA[$k] - $nilaiB[$k];

                    // fungsi preferensi tipe usual
                    $p = ($h > 0) ? 1 : 0;

                    $detail[$k] = [
                        'nilaiA' => $nilaiA[$k],
                        'nilaiB' => $nilaiB[$k],
                        'h'      => $h,
                        'p'      => $p
                    ];

                    $totalPreferensi += $p;
                }

                // π(a,b)
                $preferensi[$a][$b] = round(
                    $totalPreferensi / count($kriteria),
                    2
                );
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

        return [
            'ranking' => $ranking,
            'leavingFlows' => $leavingFlows,
            'enteringFlows' => $enteringFlows,
            'netFlows' => $netFlows,
            'rekomendasiJurusan' => $rekomendasiJurusan
        ];
    }
}
