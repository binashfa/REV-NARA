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

    public function kelolaNilai()
    {
        $siswas = Siswa::with('nilais')->get();
        $mapels = Mapel::all();

        return response()->json([
            'success' => true,
            'data' => [
                'siswas' => $siswas,
                'mapels' => $mapels
            ]
        ]);
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

        return response()->json([
            'success' => true,
            'message' => 'Nilai berhasil disimpan'
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