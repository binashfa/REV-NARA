<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Guru;
use App\Models\Operator;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Pertanyaan;
use App\Models\JawabanMinat;
use App\Models\HasilMinat;
use App\Models\PertanyaanKepribadian;
use App\Models\JawabanKepribadian;
use App\Models\HasilKepribadian;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ApiOperatorController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = Siswa::count();

        $totalGuru = Guru::count();

        $totalMapel = Mapel::count();

        $totalNilai = Nilai::count();

        $totalMinat = HasilMinat::count();

        $totalKepribadian = HasilKepribadian::count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_siswa' => $totalSiswa,
                'total_guru' => $totalGuru,
                'total_mapel' => $totalMapel,
                'total_nilai' => $totalNilai,
                'total_minat' => $totalMinat,
                'total_kepribadian' => $totalKepribadian,
            ]
        ]);
    }

    public function kelolaAkun()
    {
        $gurus = Guru::with([
            'user',
            'mapel'
        ])->get();

        $operators = Operator::with(
            'user'
        )->get();

        $mapels = Mapel::all();

        return response()->json([
            'success' => true,
            'data' => [
                'gurus' => $gurus,
                'operators' => $operators,
                'mapels' => $mapels
            ]
        ]);
    }

    public function tambahAkun(Request $request)
    {
        $request->validate([

            'username' => 'required|unique:users',

            'password' => 'required',

            'role' => 'required',

            'nama' => 'required'

        ]);

        // SIMPAN USER
        $user = User::create([

            'username' => $request->username,

            'password' => bcrypt($request->password),

            'role' => $request->role

        ]);

        // JIKA GURU
        if ($request->role == 'guru') {

            Guru::create([

                'user_id' => $user->id,

                'mapel_id' => $request->mapel_id,

                'nama' => $request->nama,

                'jenis_kelamin' => $request->jenis_kelamin

            ]);
        }

        // JIKA OPERATOR
        if ($request->role == 'operator') {

            Operator::create([

                'user_id' => $user->id,

                'nama' => $request->nama,

                'jabatan' => 'admin'

            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Akun berhasil ditambahkan'
        ]);
    }

    public function editOperator(Request $request, $id)
    {
        $operator = Operator::findOrFail($id);

        $operator->update([

            'nama' => $request->nama

        ]);

        $operator->user->update([

            'username' => $request->username

        ]);

        return back();
    }

    public function editGuru(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $guru->update([

            'nama' => $request->nama,

            'mapel_id' => $request->mapel_id

        ]);

        $guru->user->update([

            'username' => $request->username

        ]);

        return back();
    }

    public function hapusGuru($id)
    {
        $guru = Guru::findOrFail($id);

        $guru->user->delete();

        $guru->delete();

        return back();
    }

    public function hapusOperator($id)
    {
        $operator = Operator::findOrFail($id);

        $operator->user->delete();

        $operator->delete();

        return back();
    }

    public function kelolaSiswa()
    {
        $siswas = Siswa::all();

        return response()->json([
            'success' => true,
            'data' => $siswas
        ]);
    }

    public function tambahSiswa(Request $request)
    {
        $request->validate([

            'nisn' => 'required|unique:siswas',

            'nama' => 'required',

            'jenis_kelamin' => 'required',

        ]);

        Siswa::create([

            'nisn' => $request->nisn,

            'nama' => $request->nama,

            'jenis_kelamin' => $request->jenis_kelamin,

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Siswa berhasil ditambahkan'
        ]);
    }

    public function importSiswa(Request $request)
    {
        $request->validate([

            'file' => 'required|mimes:xlsx,csv,xls'

        ]);

        Excel::import(

            new SiswaImport,

            $request->file('file')

        );

        return back()->with(
            'success',
            'Import siswa berhasil'
        );
    }

    public function templateSiswa()
    {
        $filename = "template_siswa.csv";

        $headers = [

            "Content-type" => "text/csv",

            "Content-Disposition" => "attachment; filename=$filename",

            "Pragma" => "no-cache",

            "Cache-Control" => "must-revalidate",

            "Expires" => "0"

        ];

        $columns = [
            'nisn',
            'nama',
            'jenis_kelamin'
        ];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            fputcsv($file, [
                '123456789',
                'Budi',
                'Laki-laki'
            ]);

            fclose($file);
        };

        return response()->stream(
            $callback,
            200,
            $headers
        );
    }

    public function editSiswa(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->update([

            'nisn' => $request->nisn,

            'nama' => $request->nama,

            'jenis_kelamin' => $request->jenis_kelamin

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Siswa berhasil diperbarui',
            'data' => $siswa
        ]);
    }

    public function hapusSiswa($id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Siswa berhasil dihapus'
        ]);
    }

    public function kelolaMapel()
    {
        $mapels = Mapel::all();

        return response()->json([
            'success' => true,
            'data' => $mapels
        ]);
    }

    public function tambahMapel(Request $request)
    {
        $request->validate([

            'nama_mapel' => 'required'

        ]);

        Mapel::create([

            'nama_mapel' => $request->nama_mapel

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mapel berhasil ditambahkan'
        ], 201);
    }

    public function editMapel(Request $request, $id)
    {
        $request->validate([

            'nama_mapel' => 'required'

        ]);

        $mapel = Mapel::findOrFail($id);

        $mapel->update([

            'nama_mapel' => $request->nama_mapel

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mapel berhasil diupdate',
            'data' => $mapel
        ]);
    }

    public function hapusMapel($id)
    {
        $mapel = Mapel::findOrFail($id);

        $mapel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mapel berhasil dihapus'
        ]);
    }

    public function kelolaNilai(Request $request)
    {
        $mapels = Mapel::all();

        $nilais = collect(); // kosong

        if ($request->filled('mapel_id')) {

            $nilais = Nilai::with([
                'siswa',
                'guru',
                'mapel'
            ])
                ->where('mapel_id', $request->mapel_id)
                ->get();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'mapels' => $mapels,
                'nilais' => $nilais
            ]
        ]);
    }

    public function editNilai(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);

        $nilai->update([

            'uts' => $request->uts,

            'uas' => $request->uas,

            'uam' => $request->uam

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Nilai berhasil diupdate',
            'data' => $nilai
        ]);
    }

    public function kelolaMinatBakat()
    {
        $siswas = Siswa::all();

        $pertanyaans = Pertanyaan::all();

        $jawabans = JawabanMinat::all()
            ->keyBy(function ($item) {

                return $item->siswa_id . '-' . $item->pertanyaan_id;
            });

        return response()->json([
            'success' => true,
            'data' => [
                'siswas' => $siswas,
                'pertanyaans' => $pertanyaans,
                'jawabans' => $jawabans
            ]
        ]);
    }

    public function simpanMinatBakat(Request $request)
    {
        foreach ($request->jawaban as $siswa_id => $jawabanSiswa) {

            $skor = [

                'IPA' => 0,

                'IPS' => 0,

                'TKJ' => 0,

                'DKV' => 0,

                'Akuntansi' => 0,

                'Pondok Pesantren' => 0

            ];

            foreach ($jawabanSiswa as $pertanyaan_id => $nilai) {



                $pertanyaan = Pertanyaan::find($pertanyaan_id);

                JawabanMinat::updateOrCreate(

                    [

                        'siswa_id' => $siswa_id,

                        'pertanyaan_id' => $pertanyaan_id

                    ],

                    [

                        'nilai' => $nilai

                    ]

                );

                $skor[$pertanyaan->kategori] += $nilai;
            }

            $skor['IPA'] /= 2;
            $skor['IPS'] /= 2;
            $skor['TKJ'] /= 2;
            $skor['DKV'] /= 2;
            $skor['Akuntansi'] /= 2;
            $skor['Pondok Pesantren'] /= 2;

            $hasil = array_search(
                max($skor),
                $skor
            );

            HasilMinat::updateOrCreate(

                [
                    'siswa_id' => $siswa_id
                ],

                [
                    'ipa' => $skor['IPA'],

                    'ips' => $skor['IPS'],

                    'tkj' => $skor['TKJ'],

                    'dkv' => $skor['DKV'],

                    'akuntansi' => $skor['Akuntansi'],

                    'pondok_pesantren' => $skor['Pondok Pesantren'],

                    'hasil' => $hasil
                ]

            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Data minat bakat berhasil disimpan'
        ]);
    }

    public function templateMinatBakat()
    {
        $filename = "template_minat_bakat.csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate",
            "Expires" => "0"
        ];

        $siswas = Siswa::all();
        $pertanyaans = Pertanyaan::orderBy('id')->get();

        $callback = function () use ($siswas, $pertanyaans) {

            $file = fopen('php://output', 'w');

            // HEADER CSV
            $header = [
                'nama',
                'nisn'
            ];

            foreach ($pertanyaans as $index => $pertanyaan) {
                $header[] = 'p' . ($index + 1);
            }

            fputcsv($file, $header);

            // DATA SISWA
            foreach ($siswas as $siswa) {

                $row = [
                    $siswa->nama,
                    "'" . $siswa->nisn // agar NISN tidak jadi 1.23E+08
                ];

                foreach ($pertanyaans as $pertanyaan) {
                    $row[] = '';
                }

                fputcsv($file, $row);
            }

            // BARIS KOSONG
            fputcsv($file, []);
            fputcsv($file, []);

            // PERTANYAAN
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Pertanyaan :']);

            foreach ($pertanyaans as $index => $pertanyaan) {

                fputcsv($file, [
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    'P' . ($index + 1) . ' = ' . $pertanyaan->pertanyaan
                ]);
            }

            // INDIKATOR
            fputcsv($file, []);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Indikator :']);

            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '1 = Sangat Tidak Setuju']);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '2 = Tidak Setuju']);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '3 = Setuju']);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '4 = Sangat Setuju']);

            fclose($file);
        };

        return response()->stream(
            $callback,
            200,
            $headers
        );
    }

    public function importMinatBakat(Request $request)
    {
        $request->validate([

            'file' => 'required|mimes:csv,txt'

        ]);

        $file = fopen(
            $request->file('file')->getRealPath(),
            'r'
        );

        $header = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {

            $nisn = str_replace("'", "", trim($row[1]));

            $siswa = Siswa::where(
                'nisn',
                $nisn
            )->first();

            if (!$siswa) {
                continue;
            }

            $jawaban = [

                1 => $row[2],

                2 => $row[3],

                3 => $row[4],

                4 => $row[5],

                5 => $row[6],

                6 => $row[7],

                7 => $row[8],

                8 => $row[9],

                9 => $row[10],

                10 => $row[11],

                11 => $row[12],

                12 => $row[13]

            ];

            $skor = [

                'IPA' => 0,

                'IPS' => 0,

                'TKJ' => 0,

                'DKV' => 0,

                'Akuntansi' => 0,

                'Pondok Pesantren' => 0

            ];

            foreach ($jawaban as $pertanyaan_id => $nilai) {

                if ($nilai === '' || $nilai === null) {
                    continue;
                }

                $nilai = (int) $nilai;

                $pertanyaan = Pertanyaan::find($pertanyaan_id);

                JawabanMinat::updateOrCreate(
                    [
                        'siswa_id' => $siswa->id,
                        'pertanyaan_id' => $pertanyaan_id
                    ],
                    [
                        'nilai' => $nilai
                    ]
                );

                $skor[$pertanyaan->kategori] += $nilai;
            }


            $skor['IPA'] /= 2;
            $skor['IPS'] /= 2;
            $skor['TKJ'] /= 2;
            $skor['DKV'] /= 2;
            $skor['Akuntansi'] /= 2;
            $skor['Pondok Pesantren'] /= 2;

            $hasil = array_search(
                max($skor),
                $skor
            );

            HasilMinat::updateOrCreate(

                [
                    'siswa_id' => $siswa->id
                ],

                [
                    'ipa' => $skor['IPA'],

                    'ips' => $skor['IPS'],

                    'tkj' => $skor['TKJ'],

                    'dkv' => $skor['DKV'],

                    'akuntansi' => $skor['Akuntansi'],

                    'pondok_pesantren' => $skor['Pondok Pesantren'],

                    'hasil' => $hasil
                ]

            );
        }

        fclose($file);

        return response()->json([
            'success' => true,
            'message' => 'Import minat bakat berhasil'
        ]);
    }

    public function kelolaKepribadian()
    {
        $siswas = Siswa::all();
        $pertanyaans = PertanyaanKepribadian::all();
        $jawabans = JawabanKepribadian::all()->keyBy(function ($item) {
            return $item->siswa_id . '-' . $item->pertanyaan_kepribadian_id;
        });

        return response()->json([
            'success' => true,
            'data' => [
                'siswas' => $siswas,
                'pertanyaans' => $pertanyaans,
                'jawabans' => $jawabans
            ]
        ]);
    }

    public function simpanKepribadian(Request $request)
    {
        foreach ($request->jawaban as $siswa_id => $jawabanSiswa) {

            $skor = [

                'IPA' => 0,
                'IPS' => 0,
                'TKJ' => 0,
                'DKV' => 0,
                'Akuntansi' => 0,
                'Pondok Pesantren' => 0

            ];

            foreach ($jawabanSiswa as $pertanyaan_id => $nilai) {

                // LEWATI JIKA KOSONG
                if ($nilai === null || $nilai === '') {
                    continue;
                }

                $nilai = (int) $nilai;

                $pertanyaan = PertanyaanKepribadian::find($pertanyaan_id);

                JawabanKepribadian::updateOrCreate(

                    [
                        'siswa_id' => $siswa_id,
                        'pertanyaan_kepribadian_id' => $pertanyaan_id
                    ],

                    [
                        'nilai' => $nilai
                    ]

                );

                $skor[$pertanyaan->kategori] += $nilai;
            }

            $skor['IPA'] /= 2;
            $skor['IPS'] /= 2;
            $skor['TKJ'] /= 2;
            $skor['DKV'] /= 2;
            $skor['Akuntansi'] /= 2;
            $skor['Pondok Pesantren'] /= 2;

            $hasil = array_search(
                max($skor),
                $skor
            );

            HasilKepribadian::updateOrCreate(

                [
                    'siswa_id' => $siswa_id
                ],

                [
                    'ipa' => $skor['IPA'],
                    'ips' => $skor['IPS'],
                    'tkj' => $skor['TKJ'],
                    'dkv' => $skor['DKV'],
                    'akuntansi' => $skor['Akuntansi'],
                    'pondok_pesantren' => $skor['Pondok Pesantren'],
                    'hasil' => $hasil
                ]

            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Data kepribadian berhasil disimpan'
        ]);
    }

    public function templateKepribadian()
    {
        $filename = "template_kepribadian.csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate",
            "Expires" => "0"
        ];

        $siswas = Siswa::all();
        $pertanyaans = PertanyaanKepribadian::orderBy('id')->get();

        $callback = function () use ($siswas, $pertanyaans) {

            $file = fopen('php://output', 'w');

            // Header
            $header = [
                'nama',
                'nisn'
            ];

            foreach ($pertanyaans as $index => $pertanyaan) {
                $header[] = 'p' . ($index + 1);
            }

            fputcsv($file, $header);

            // Data siswa
            foreach ($siswas as $siswa) {

                $row = [
                    $siswa->nama,
                    "'" . $siswa->nisn // supaya NISN tidak berubah jadi notasi ilmiah
                ];

                foreach ($pertanyaans as $pertanyaan) {
                    $row[] = '';
                }

                fputcsv($file, $row);
            }

            // Baris kosong
            fputcsv($file, []);
            fputcsv($file, []);

            // Daftar pertanyaan
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Pertanyaan :']);

            foreach ($pertanyaans as $index => $pertanyaan) {

                fputcsv($file, [
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    'P' . ($index + 1) . ' = ' . $pertanyaan->pertanyaan
                ]);
            }

            // Indikator
            fputcsv($file, []);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Indikator :']);

            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '1 = Sangat Tidak Setuju']);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '2 = Tidak Setuju']);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '3 = Setuju']);
            fputcsv($file, ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '4 = Sangat Setuju']);

            fclose($file);
        };

        return response()->stream(
            $callback,
            200,
            $headers
        );
    }

    public function importKepribadian(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv,txt']);
        $file = fopen($request->file('file')->getRealPath(), 'r');
        $header = fgetcsv($file);
        while (($row = fgetcsv($file)) !== false) {
            $nisn = $row[1];
            $siswa = Siswa::where('nisn', $nisn)->first();
            if (!$siswa) {
                continue;
            }
            $jawaban = [1 => $row[2], 2 => $row[3], 3 => $row[4], 4 => $row[5], 5 => $row[6], 6 => $row[7], 7 => $row[8], 8 => $row[9], 9 => $row[10], 10 => $row[11], 11 => $row[12], 12 => $row[13]];
            $skor = ['IPA' => 0, 'IPS' => 0, 'TKJ' => 0, 'DKV' => 0, 'Akuntansi' => 0, 'Pondok Pesantren' => 0];
            foreach ($jawaban as $pertanyaan_id => $nilai) {

                // LEWATI JIKA KOSONG
                if ($nilai === '' || $nilai === null) {
                    continue;
                }

                $nilai = (int) $nilai;

                $pertanyaan = PertanyaanKepribadian::find($pertanyaan_id);

                JawabanKepribadian::updateOrCreate(

                    [
                        'siswa_id' => $siswa->id,
                        'pertanyaan_kepribadian_id' => $pertanyaan_id
                    ],

                    [
                        'nilai' => $nilai
                    ]

                );

                $skor[$pertanyaan->kategori] += $nilai;
            }

            $skor['IPA'] /= 2;
            $skor['IPS'] /= 2;
            $skor['TKJ'] /= 2;
            $skor['DKV'] /= 2;
            $skor['Akuntansi'] /= 2;
            $skor['Pondok Pesantren'] /= 2;

            $hasil = array_search(max($skor), $skor);
            HasilKepribadian::updateOrCreate(['siswa_id' => $siswa->id], ['ipa' => $skor['IPA'], 'ips' => $skor['IPS'], 'tkj' => $skor['TKJ'], 'dkv' => $skor['DKV'], 'akuntansi' => $skor['Akuntansi'], 'pondok_pesantren' => $skor['Pondok Pesantren'], 'hasil' => $hasil]);
        }
        fclose($file);
        return response()->json([
            'success' => true,
            'message' => 'Import kepribadian berhasil'
        ]);
    }



    public function setting()
    {
        $operator = Operator::where(
            'user_id',
            Auth::id()
        )->first();

        return response()->json([
            'success' => true,
            'data' => $operator
        ]);
    }

    public function updateSetting(Request $request)
    {
        $request->validate([

            'username' => 'required',

            'nama' => 'required',

            'password' => 'nullable|min:6|confirmed'

        ]);

        $user = User::find(
            Auth::id()
        );

        $user->username = $request->username;

        if ($request->password) {

            $user->password = bcrypt(
                $request->password
            );
        }

        $user->save();

        $operator = Operator::where(
            'user_id',
            Auth::id()
        )->first();

        $operator->nama = $request->nama;

        $operator->save();

        return response()->json([
            'success' => true,
            'message' => 'Setting berhasil diperbarui',
            'data' => [
                'user' => $user,
                'operator' => $operator
            ]
        ]);
    }
}
