<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return response()->json([
            'success' => true,
            'data' => [
                'jumlah_siswa' => $jumlahSiswa,
                'jumlah_nilai' => $jumlahNilai,
                'guru' => $guru,
                'nilai_terbaru' => $nilaiTerbaru
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

        foreach ($request->nilai as $siswaId => $data) {

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

    public function setting()
    {
        $guru = Auth::user()->guru;

        return response()->json([
            'success' => true,
            'data' => $guru
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

        $user->username = $request->username;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        if ($user->guru) {
            $user->guru->update([
                'nama' => $request->nama
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Setting berhasil diperbarui'
        ]);
    }
}
