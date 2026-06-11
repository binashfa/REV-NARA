<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\PrometheeController;

class ApiGuruController extends Controller
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

        $siswas = Siswa::with([
            'nilais.mapel',
            'hasilMinat',
            'hasilKepribadian'
        ])->get();

        $rekomendasiJurusan = [];

        foreach ($siswas as $siswa) {
            try {
                $hasil = PrometheeController::getHasilPromethee($siswa);

                $jurusan = $hasil['rekomendasiJurusan'] ?? null;

                if ($jurusan) {
                    $rekomendasiJurusan[$jurusan][] = [
                        'id' => $siswa->id,
                        'nama' => $siswa->nama,
                    ];
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'jumlah_siswa' => $jumlahSiswa,
                'jumlah_nilai' => $jumlahNilai,
                'guru' => $guru,
                'nilai_terbaru' => $nilaiTerbaru,
                'rekomendasi_jurusan' => $rekomendasiJurusan,
            ]
        ]);
    }


    public function kelolaNilai(Request $request)
    {
        $mapelId = $request->mapel_id;

        $mapels = Mapel::all();

        $siswas = Siswa::with([
            'nilais' => function ($query) use ($mapelId) {
                $query->where('mapel_id', $mapelId);
            }
        ])->get();

        return response()->json([
            'success' => true,
            'data' => [
                'mapels' => $mapels,
                'siswas' => $siswas,
                'selected_mapel' => $mapelId
            ]
        ]);
    }

    public function simpanNilai(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required',
            'nilai' => 'required|array'
        ]);

        foreach ($request->nilai as $data) {
            $siswaId = $data['id'];

            Nilai::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'mapel_id' => $request->mapel_id
                ],
                [
                    'guru_id' => Auth::user()->guru->id,
                    'uts' => $data['uts'] ?? null,
                    'uas' => $data['uas'] ?? null,
                    'uam' => $data['uam'] ?? null
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Nilai berhasil disimpan'
        ]);
    }

    public function templateNilai()
    {
        $siswas = Siswa::all();

        $filename = storage_path('app/template_nilai.csv');

        $file = fopen($filename, 'w');

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

        return response()->download($filename);
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

            $nisn = trim(str_replace("'", "", $row[0]));

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
                    'uts' => $row[2] ?: null,
                    'uas' => $row[3] ?: null,
                    'uam' => $row[4] ?: null
                ]
            );
        }

        fclose($file);

        return response()->json([
            'success' => true,
            'message' => 'Import nilai berhasil'
        ]);
    }

    public function raport(Request $request)
    {
        $siswas = Siswa::all();

        $siswaId = $request->siswa_id;

        $data = [
            'siswas' => $siswas,
            'siswa' => null,
            'ranking' => [],
            'leavingFlows' => [],
            'enteringFlows' => [],
            'netFlows' => [],
            'rekomendasiJurusan' => null,
        ];

        if ($siswaId) {

            $siswa = Siswa::with([
                'nilais.mapel',
                'hasilMinat',
                'hasilKepribadian'
            ])->findOrFail($siswaId);

            $hasil = PrometheeController::getHasilPromethee($siswa);

            $data['siswa'] = $siswa;
            $data['ranking'] = $hasil['ranking'];
            $data['leavingFlows'] = $hasil['leavingFlows'];
            $data['enteringFlows'] = $hasil['enteringFlows'];
            $data['netFlows'] = $hasil['netFlows'];
            $data['rekomendasiJurusan'] = $hasil['rekomendasiJurusan'];
        }

        return response()->json([
            'success' => true,
            'message' => 'Data raport berhasil diambil',
            'data' => $data
        ]);
    }

    public function exportRaportPdf($id)
    {
        $siswa = Siswa::with([
            'nilais.mapel',
            'hasilMinat',
            'hasilKepribadian'
        ])->findOrFail($id);

        $hasil = PrometheeController::getHasilPromethee($siswa);

        $pdf = Pdf::loadView(
            'guru.raport-pdf',
            [
                'siswa' => $siswa,
                'ranking' => $hasil['ranking'],
                'leavingFlows' => $hasil['leavingFlows'],
                'enteringFlows' => $hasil['enteringFlows'],
                'netFlows' => $hasil['netFlows'],
                'rekomendasiJurusan' => $hasil['rekomendasiJurusan']
            ]
        );

        return $pdf->download(
            'raport-' . $siswa->nama . '.pdf'
        );
    }

    public function setting()
    {
        $user = Auth::user();
        $guru = $user->guru;

        return response()->json([
            'success' => true,
            'message' => 'Data setting berhasil diambil',
            'data' => [
                'guru' => $guru,
                'user' => $user,
            ]
        ]);
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

        return response()->json([
            'success' => true,
            'message' => 'Setting berhasil diperbarui',
            'data' => [
                'user' => $user->fresh(),
                'guru' => $guru?->fresh()
            ]
        ]);
    }
}
