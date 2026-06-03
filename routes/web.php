<?php

use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OperatorController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| REDIRECT OPERATOR (FIX 404)
|--------------------------------------------------------------------------
*/

Route::get('/operator', function () {
    return redirect('/operator/dashboard');
});

/*
|--------------------------------------------------------------------------
| GURU
|--------------------------------------------------------------------------
*/

Route::middleware(['role:guru'])->group(function () {

    Route::get('/guru', [GuruController::class, 'dashboard']);

    Route::get('/guru/kelola-nilai', [GuruController::class, 'kelolaNilai']);
    Route::post('/guru/simpan-nilai', [GuruController::class, 'simpanNilai']);

    Route::get('/guru/template-nilai', [GuruController::class, 'templateNilai']);
    Route::post('/guru/import-nilai', [GuruController::class, 'importNilai']);

    Route::get('/guru/raport', [GuruController::class, 'raport']);
    Route::get('/guru/raport-pdf/{id}', [GuruController::class, 'exportRaportPdf']);

    Route::get('/guru/setting', [GuruController::class, 'setting']);
    Route::post('/guru/update-setting', [GuruController::class, 'updateSetting']);
});

/*
|--------------------------------------------------------------------------
| OPERATOR
|--------------------------------------------------------------------------
*/

Route::middleware(['role:operator'])->group(function () {

    Route::get('/operator/dashboard', [OperatorController::class, 'dashboard']);

    Route::get('/operator/kelola-akun', [OperatorController::class, 'kelolaAkun']);
    Route::post('/operator/tambah-akun', [OperatorController::class, 'tambahAkun']);

    Route::put('/operator/edit-guru/{id}', [OperatorController::class, 'editGuru']);
    Route::put('/operator/edit-operator/{id}', [OperatorController::class, 'editOperator']);

    Route::delete('/operator/hapus-guru/{id}', [OperatorController::class, 'hapusGuru']);
    Route::delete('/operator/hapus-operator/{id}', [OperatorController::class, 'hapusOperator']);

    Route::get('/operator/kelola-siswa', [OperatorController::class, 'kelolaSiswa']);
    Route::post('/operator/tambah-siswa', [OperatorController::class, 'tambahSiswa']);
    Route::post('/operator/import-siswa', [OperatorController::class, 'importSiswa']);
    Route::get('/operator/template-siswa', [OperatorController::class, 'templateSiswa']);
    Route::put('/operator/edit-siswa/{id}', [OperatorController::class, 'editSiswa']);
    Route::delete('/operator/hapus-siswa/{id}', [OperatorController::class, 'hapusSiswa']);

    Route::get('/operator/kelola-mapel', [OperatorController::class, 'kelolaMapel']);
    Route::post('/operator/tambah-mapel', [OperatorController::class, 'tambahMapel']);
    Route::put('/operator/edit-mapel/{id}', [OperatorController::class, 'editMapel']);
    Route::delete('/operator/hapus-mapel/{id}', [OperatorController::class, 'hapusMapel']);

    Route::get('/operator/kelola-nilai', [OperatorController::class, 'kelolaNilai']);
    Route::put('/operator/edit-nilai/{id}', [OperatorController::class, 'editNilai']);

    Route::get('/operator/kelola-minat-bakat', [OperatorController::class, 'kelolaMinatBakat']);
    Route::post('/operator/simpan-minat-bakat', [OperatorController::class, 'simpanMinatBakat']);
    Route::get('/operator/template-minat-bakat', [OperatorController::class, 'templateMinatBakat']);
    Route::post('/operator/import-minat-bakat', [OperatorController::class, 'importMinatBakat']);

    Route::get('/operator/kelola-kepribadian', [OperatorController::class, 'kelolaKepribadian']);
    Route::post('/operator/simpan-kepribadian', [OperatorController::class, 'simpanKepribadian']);
    Route::get('/operator/template-kepribadian', [OperatorController::class, 'templateKepribadian']);
    Route::post('/operator/import-kepribadian', [OperatorController::class, 'importKepribadian']);

    Route::get('/operator/setting', [OperatorController::class, 'setting']);
    Route::post('/operator/update-setting', [OperatorController::class, 'updateSetting']);
});