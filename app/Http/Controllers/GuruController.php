<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;


class GuruController extends Controller
{
    public function dashboard()
    {
        $jumlahSiswa = Siswa::count();

        $jumlahNilai = Nilai::count();

        $guru = Auth::user()->guru;

        $nilaiTerbaru = Nilai::with([
            'siswa',
            'mapel'
        ])->latest()->take(5)->get();

        return view(
            'guru.dashboard',
            compact(
                'jumlahSiswa',
                'jumlahNilai',
                'guru',
                'nilaiTerbaru'
            )
        );
    }

    public function kelolaNilai(Request $request)
    {
        $mapelId = $request->mapel_id;

        $siswas = Siswa::with('nilais')->get();

        $mapels = Mapel::all();

        return view(
            'guru.kelola-nilai',
            compact(
                'siswas',
                'mapels',
                'mapelId'
            )
        );
    }

    public function simpanNilai(Request $request)
    {
        foreach ($request->nilai as $siswaId => $data) {

            Nilai::updateOrCreate(

                [

                    'siswa_id' => $siswaId,

                    'mapel_id' => $request->mapel_id

                ],

                [

                    'guru_id' => Auth::user()->guru->id,

                    'uts' => $data['uts'],

                    'uas' => $data['uas'],

                    'uam' => $data['uam']

                ]

            );
        }

        return back()->with(
            'success',
            'Nilai berhasil disimpan'
        );
    }

    public function templateNilai(Request $request)
    {
        $mapelId = $request->mapel_id;

        if (!$mapelId) {
            return back();
        }

        $siswas = Siswa::all();

        $filename = "template_nilai.csv";

        $headers = [

            "Content-type" => "text/csv",

            "Content-Disposition" => "attachment; filename=$filename",

            "Pragma" => "no-cache",

            "Cache-Control" => "must-revalidate",

            "Expires" => "0"

        ];

        $callback = function () use ($siswas) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [

                'NISN',

                'Nama',

                'UTS',

                'UAS',

                'UAM'

            ]);

            foreach ($siswas as $siswa) {

                fputcsv($file, [

                    $siswa->nisn,

                    $siswa->nama,

                    '',

                    '',

                    ''

                ]);
            }

            fclose($file);
        };

        return Response::stream(
            $callback,
            200,
            $headers
        );
    }

    public function importNilai(Request $request)
    {
        $request->validate([

            'file' => 'required|mimes:csv,txt',

            'mapel_id' => 'required'

        ]);

        $file = fopen(
            $request->file('file')->getRealPath(),
            'r'
        );

        fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {

            $nisn = $row[0];

            $uts = $row[2] === '' ? null : $row[2];

            $uas = $row[3] === '' ? null : $row[3];

            $uam = ($row[4] ?? '') === '' ? null : $row[4];

            $siswa = Siswa::where(
                'nisn',
                $nisn
            )->first();

            if (!$siswa) {
                continue;
            }

            Nilai::updateOrCreate(

                [

                    'siswa_id' => $siswa->id,

                    'mapel_id' => $request->mapel_id

                ],

                [

                    'guru_id' => Auth::user()->guru->id,

                    'uts' => $uts,

                    'uas' => $uas,

                    'uam' => $uam

                ]

            );
        }

        fclose($file);

        return back()->with(
            'success',
            'Import nilai berhasil'
        );
    }

    public function raport(Request $request)
    {
        $siswas = Siswa::all();

        $siswaId = $request->siswa_id;

        $siswa = null;

        $ranking = [];

        $leavingFlows = [];

        $enteringFlows = [];

        $netFlows = [];

        if ($siswaId) {

            $siswa = Siswa::with([
                'nilais.mapel',
                'hasilMinat',
                'hasilKepribadian'
            ])->find($siswaId);

            // =========================
            // NILAI MAPEL
            // =========================

            $mapel = [];

            foreach ($siswa->nilais as $nilai) {

                $rata = (
                    ($nilai->uts ?? 0) +
                    ($nilai->uas ?? 0) +
                    ($nilai->uam ?? 0)
                ) / 3;

                $mapel[strtolower($nilai->mapel->nama_mapel)] = $rata;
            }

            // =========================
            // NILAI PENDUKUNG JURUSAN
            // =========================

            $ipaAkademik = (
                ($mapel['matematika'] ?? 0) +
                ($mapel['ipa'] ?? 0) +
                ($mapel['bahasa indonesia'] ?? 0)
            ) / 3;

            $ipsAkademik = (
                ($mapel['ips'] ?? 0) +
                ($mapel['ppkn'] ?? 0) +
                ($mapel['bahasa inggris'] ?? 0)
            ) / 3;

            $tkjAkademik = (
                ($mapel['tik'] ?? 0) +
                ($mapel['matematika'] ?? 0) +
                ($mapel['bahasa inggris'] ?? 0)
            ) / 3;

            $dkvAkademik = (
                ($mapel['sbdp'] ?? 0) +
                ($mapel['matematika'] ?? 0) +
                ($mapel['bahasa indonesia'] ?? 0)
            ) / 3;

            $akuntansiAkademik = (
                ($mapel['matematika'] ?? 0) +
                ($mapel['bahasa indonesia'] ?? 0) +
                ($mapel['bahasa inggris'] ?? 0)
            ) / 3;

            $ponpesAkademik = (
                ($mapel['bahasa arab'] ?? 0) +
                ($mapel['btq'] ?? 0) +
                ($mapel['bahasa indonesia'] ?? 0)
            ) / 3;

            // =========================
            // KONVERSI AKADEMIK
            // =========================

            function konversi($nilai)
            {
                if ($nilai >= 90) {
                    return 5;
                } elseif ($nilai >= 85) {
                    return 4;
                } elseif ($nilai >= 80) {
                    return 3;
                } elseif ($nilai >= 75) {
                    return 2;
                } else {
                    return 1;
                }
            }

            // =========================
            // DATA ALTERNATIF
            // =========================

            $alternatif = [

                'IPA' => [

                    'akademik' => konversi($ipaAkademik),

                    'minat' => $siswa->hasilMinat->ipa ?? 0,

                    'kepribadian' => $siswa->hasilKepribadian->ipa ?? 0

                ],

                'IPS' => [

                    'akademik' => konversi($ipsAkademik),

                    'minat' => $siswa->hasilMinat->ips ?? 0,

                    'kepribadian' => $siswa->hasilKepribadian->ips ?? 0

                ],

                'TKJ' => [

                    'akademik' => konversi($tkjAkademik),

                    'minat' => $siswa->hasilMinat->tkj ?? 0,

                    'kepribadian' => $siswa->hasilKepribadian->tkj ?? 0

                ],

                'DKV' => [

                    'akademik' => konversi($dkvAkademik),

                    'minat' => $siswa->hasilMinat->dkv ?? 0,

                    'kepribadian' => $siswa->hasilKepribadian->dkv ?? 0

                ],

                'Akuntansi' => [

                    'akademik' => konversi($akuntansiAkademik),

                    'minat' => $siswa->hasilMinat->akuntansi ?? 0,

                    'kepribadian' => $siswa->hasilKepribadian->akuntansi ?? 0

                ],

                'Ponpes' => [

                    'akademik' => konversi($ponpesAkademik),

                    'minat' => $siswa->hasilMinat->pondok_pesantren ?? 0,

                    'kepribadian' => $siswa->hasilKepribadian->pondok_pesantren ?? 0

                ]

            ];

            // =========================
            // KONVERSI MINAT
            // =========================

            foreach ($alternatif as $jurusan => $nilai) {

                $minat = $nilai['minat'];

                if ($minat >= 7) {

                    $alternatif[$jurusan]['minat'] = 5;
                } elseif ($minat == 6) {

                    $alternatif[$jurusan]['minat'] = 4;
                } elseif ($minat == 5) {

                    $alternatif[$jurusan]['minat'] = 3;
                } elseif ($minat == 4) {

                    $alternatif[$jurusan]['minat'] = 2;
                } else {

                    $alternatif[$jurusan]['minat'] = 1;
                }
            }

            // =========================
            // KONVERSI KEPRIBADIAN
            // =========================

            foreach ($alternatif as $jurusan => $nilai) {

                $kepribadian = $nilai['kepribadian'];

                if ($kepribadian >= 3.5) {

                    $alternatif[$jurusan]['kepribadian'] = 5;
                } elseif ($kepribadian >= 3.0) {

                    $alternatif[$jurusan]['kepribadian'] = 4;
                } elseif ($kepribadian >= 2.5) {

                    $alternatif[$jurusan]['kepribadian'] = 3;
                } elseif ($kepribadian >= 2.0) {

                    $alternatif[$jurusan]['kepribadian'] = 2;
                } else {

                    $alternatif[$jurusan]['kepribadian'] = 1;
                }
            }

            // =========================
            // BOBOT
            // =========================

            $bobot = [

                'akademik' => 5,

                'minat' => 5,

                'kepribadian' => 5

            ];

            // =========================
            // PREFERENSI
            // =========================

            $preferensi = [];

            foreach ($alternatif as $a => $nilaiA) {

                foreach ($alternatif as $b => $nilaiB) {

                    if ($a == $b) {

                        $preferensi[$a][$b] = 0;

                        continue;
                    }

                    $d1 =
                        ($nilaiA['akademik'] - $nilaiB['akademik'])
                        * $bobot['akademik'];

                    $d2 =
                        ($nilaiA['minat'] - $nilaiB['minat'])
                        * $bobot['minat'];

                    $d3 =
                        ($nilaiA['kepribadian'] - $nilaiB['kepribadian'])
                        * $bobot['kepribadian'];

                    $total = $d1 + $d2 + $d3;

                    $preferensi[$a][$b] =
                        $total > 0 ? $total : 0;
                }
            }

            // =========================
            // LEAVING FLOW
            // =========================

            foreach ($preferensi as $a => $row) {

                $leavingFlows[$a] =

                    array_sum($row) /

                    (count($alternatif) - 1);
            }

            // =========================
            // ENTERING FLOW
            // =========================

            foreach ($alternatif as $a => $v) {

                $jumlah = 0;

                foreach ($preferensi as $x => $row) {

                    $jumlah += $row[$a];
                }

                $enteringFlows[$a] =

                    $jumlah /

                    (count($alternatif) - 1);
            }

            // =========================
            // NET FLOW
            // =========================

            foreach ($alternatif as $a => $v) {

                $netFlows[$a] =

                    $leavingFlows[$a] -

                    $enteringFlows[$a];
            }

            // =========================
            // RANKING
            // =========================

            $ranking = $netFlows;

            arsort($ranking);
        }

        return view(
            'guru.raport',
            compact(
                'siswas',
                'siswa',
                'siswaId',
                'ranking',
                'leavingFlows',
                'enteringFlows',
                'netFlows'
            )
        );
    }

    public function exportRaportPdf($id)
    {
        $siswa = Siswa::with([
            'nilais.mapel',
            'hasilMinat',
            'hasilKepribadian'
        ])->findOrFail($id);

        $ranking = [];
        $leavingFlows = [];
        $enteringFlows = [];
        $netFlows = [];

        // =========================
        // RATA AKADEMIK
        // =========================

        $rataAkademik = $siswa->nilais->avg(function ($n) {

            return (
                ($n->uts ?? 0) +
                ($n->uas ?? 0) +
                ($n->uam ?? 0)
            ) / 3;
        });

        // =========================
        // KONVERSI AKADEMIK
        // =========================

        if ($rataAkademik >= 90) {

            $c1 = 5;
        } elseif ($rataAkademik >= 85) {

            $c1 = 4;
        } elseif ($rataAkademik >= 80) {

            $c1 = 3;
        } elseif ($rataAkademik >= 75) {

            $c1 = 2;
        } else {

            $c1 = 1;
        }

        // =========================
        // DATA ALTERNATIF
        // =========================

        $alternatif = [

            'IPA' => [
                'akademik' => $c1,
                'minat' => $siswa->hasilMinat->ipa ?? 0,
                'kepribadian' => $siswa->hasilKepribadian->ipa ?? 0
            ],

            'IPS' => [
                'akademik' => $c1,
                'minat' => $siswa->hasilMinat->ips ?? 0,
                'kepribadian' => $siswa->hasilKepribadian->ips ?? 0
            ],

            'TKJ' => [
                'akademik' => $c1,
                'minat' => $siswa->hasilMinat->tkj ?? 0,
                'kepribadian' => $siswa->hasilKepribadian->tkj ?? 0
            ],

            'DKV' => [
                'akademik' => $c1,
                'minat' => $siswa->hasilMinat->dkv ?? 0,
                'kepribadian' => $siswa->hasilKepribadian->dkv ?? 0
            ],

            'Akuntansi' => [
                'akademik' => $c1,
                'minat' => $siswa->hasilMinat->akuntansi ?? 0,
                'kepribadian' => $siswa->hasilKepribadian->akuntansi ?? 0
            ],

            'Ponpes' => [
                'akademik' => $c1,
                'minat' => $siswa->hasilMinat->pondok_pesantren ?? 0,
                'kepribadian' => $siswa->hasilKepribadian->pondok_pesantren ?? 0
            ]

        ];

        // =========================
        // BOBOT
        // =========================

        $bobot = [
            'akademik' => 5,
            'minat' => 5,
            'kepribadian' => 5
        ];

        // =========================
        // PREFERENSI
        // =========================

        $preferensi = [];

        foreach ($alternatif as $a => $nilaiA) {

            foreach ($alternatif as $b => $nilaiB) {

                if ($a == $b) {

                    $preferensi[$a][$b] = 0;

                    continue;
                }

                $d1 =
                    ($nilaiA['akademik'] - $nilaiB['akademik'])
                    * $bobot['akademik'];

                $d2 =
                    ($nilaiA['minat'] - $nilaiB['minat'])
                    * $bobot['minat'];

                $d3 =
                    ($nilaiA['kepribadian'] - $nilaiB['kepribadian'])
                    * $bobot['kepribadian'];

                $total = $d1 + $d2 + $d3;

                $preferensi[$a][$b] =
                    $total > 0 ? $total : 0;
            }
        }

        // =========================
        // LEAVING FLOW
        // =========================

        foreach ($preferensi as $a => $row) {

            $leavingFlows[$a] =

                array_sum($row) /

                (count($alternatif) - 1);
        }

        // =========================
        // ENTERING FLOW
        // =========================

        foreach ($alternatif as $a => $v) {

            $jumlah = 0;

            foreach ($preferensi as $x => $row) {

                $jumlah += $row[$a];
            }

            $enteringFlows[$a] =

                $jumlah /

                (count($alternatif) - 1);
        }

        // =========================
        // NET FLOW
        // =========================

        foreach ($alternatif as $a => $v) {

            $netFlows[$a] =

                $leavingFlows[$a] -

                $enteringFlows[$a];
        }

        $ranking = $netFlows;

        arsort($ranking);

        $pdf = Pdf::loadView(
            'guru.raport-pdf',
            compact(
                'siswa',
                'ranking',
                'leavingFlows',
                'enteringFlows',
                'netFlows'
            )
        );

        return $pdf->download(
            'raport-' . $siswa->nama . '.pdf'
        );
    }

    public function setting()
    {
        $guru = Auth::user()->guru;

        return view(
            'guru.setting',
            compact('guru')
        );
    }

    public function updateSetting(Request $request)
    {
        $request->validate([

            'username' => 'required',

            'nama' => 'required',

            'password' => 'nullable|min:6|confirmed'

        ]);

        $user = User::find(Auth::id());

        $user->update([

            'username' => $request->username,

            'password' => $request->password
                ? bcrypt($request->password)
                : $user->password

        ]);

        $guru = $user->guru;

        if ($guru) {

            $guru->update([

                'nama' => $request->nama

            ]);
        }

        return back()->with(

            'success',

            'Setting berhasil diperbarui'

        );
    }
}
