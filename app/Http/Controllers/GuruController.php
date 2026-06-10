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
use App\Http\Controllers\PrometheeController;
use App\Models\HasilPromethee;

class GuruController extends Controller
{
    public function dashboard()
    {
        $guru = Auth::user()->guru;

        $jumlahSiswa = Siswa::count();

        $jumlahNilai = Nilai::count();

        $nilaiTerbaru = Nilai::with([
            'siswa',
            'mapel'
        ])
            ->latest()
            ->take(5)
            ->get();

        foreach (Siswa::all() as $siswa) {

            $hasil = PrometheeController::getHasilPromethee($siswa);

            $jurusan = $hasil['rekomendasiJurusan'];

            $hasilPromethee[$jurusan][] = $siswa;
        }

        return view(
            'guru.dashboard',
            compact(
                'guru',
                'jumlahSiswa',
                'jumlahNilai',
                'nilaiTerbaru',
                'hasilPromethee'
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

            $nisn = trim(str_replace("'", "", $row[0]));

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
        $rekomendasiJurusan = null;

        if ($siswaId) {

            $siswa = Siswa::with([
                'nilais.mapel',
                'hasilMinat',
                'hasilKepribadian'
            ])->findOrFail($siswaId);

            $hasil = PrometheeController::getHasilPromethee($siswa);

            $ranking = $hasil['ranking'];
            $leavingFlows = $hasil['leavingFlows'];
            $enteringFlows = $hasil['enteringFlows'];
            $netFlows = $hasil['netFlows'];
            $rekomendasiJurusan = $hasil['rekomendasiJurusan'];
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
                'netFlows',
                'rekomendasiJurusan'
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

        $hasil = PrometheeController::getHasilPromethee($siswa);

        $ranking = $hasil['ranking'];
        $leavingFlows = $hasil['leavingFlows'];
        $enteringFlows = $hasil['enteringFlows'];
        $netFlows = $hasil['netFlows'];
        $rekomendasiJurusan = $hasil['rekomendasiJurusan'];

        $pdf = Pdf::loadView(
            'guru.raport-pdf',
            compact(
                'siswa',
                'ranking',
                'leavingFlows',
                'enteringFlows',
                'netFlows',
                'rekomendasiJurusan'
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
