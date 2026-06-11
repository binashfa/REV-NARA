<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiGuruController;
use App\Http\Controllers\Api\ApiOperatorController;
use App\Http\Controllers\Api\ApiPrometheeController;

Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [ApiAuthController::class, 'logout']);

    Route::get('/me', [ApiAuthController::class, 'me']);

    Route::prefix('guru')->group(function () {

        Route::get('/dashboard', [ApiGuruController::class, 'dashboard']);

        Route::get('/nilai', [ApiGuruController::class, 'kelolaNilai']);
        Route::post('/nilai', [ApiGuruController::class, 'simpanNilai']);
        Route::post('/nilai/import', [ApiGuruController::class, 'importNilai']);
        Route::get('/nilai/template', [ApiGuruController::class, 'templateNilai']);

        Route::get('/guru/promethee', [ApiPrometheeController::class, 'promethee']);

        Route::get('/setting', [ApiGuruController::class, 'setting']);
        Route::put('/setting', [ApiGuruController::class, 'updateSetting']);

        Route::get('/raport', [ApiGuruController::class, 'raport']);
        Route::get('/raport/export/{id}', [ApiGuruController::class, 'exportRaportPdf']);
    });

    Route::prefix('operator')->group(function () {

        Route::get('/dashboard', [ApiOperatorController::class, 'dashboard']);

        // AKUN
        Route::get('/kelola-akun', [ApiOperatorController::class, 'kelolaAkun']);
        Route::post('/tambah-akun', [ApiOperatorController::class, 'tambahAkun']);

        Route::put('/edit-guru/{id}', [ApiOperatorController::class, 'editGuru']);
        Route::put('/edit-operator/{id}', [ApiOperatorController::class, 'editOperator']);

        Route::delete('/hapus-guru/{id}', [ApiOperatorController::class, 'hapusGuru']);
        Route::delete('/hapus-operator/{id}', [ApiOperatorController::class, 'hapusOperator']);

        // MAPEL
        Route::get('/mapel', [ApiOperatorController::class, 'kelolaMapel']);
        Route::post('/mapel', [ApiOperatorController::class, 'tambahMapel']);
        Route::put('/mapel/{id}', [ApiOperatorController::class, 'editMapel']);
        Route::delete('/mapel/{id}', [ApiOperatorController::class, 'hapusMapel']);

        // NILAI
        Route::get('/nilai', [ApiOperatorController::class, 'kelolaNilai']);
        Route::put('/nilai/{id}', [ApiOperatorController::class, 'editNilai']);

        // MINAT BAKAT
        Route::get('/minat-bakat', [ApiOperatorController::class, 'kelolaMinatBakat']);
        Route::post('/minat-bakat', [ApiOperatorController::class, 'simpanMinatBakat']);
        Route::post('/minat-bakat/import', [ApiOperatorController::class, 'importMinatBakat']);
        Route::get('/minat-bakat/template', [ApiOperatorController::class, 'templateMinatBakat']);

        // KEPRIBADIAN
        Route::get('/kepribadian', [ApiOperatorController::class, 'kelolaKepribadian']);
        Route::post('/kepribadian', [ApiOperatorController::class, 'simpanKepribadian']);
        Route::post('/kepribadian/import', [ApiOperatorController::class, 'importKepribadian']);
        Route::get('/kepribadian/template', [ApiOperatorController::class, 'templateKepribadian']);

        // SETTING
        Route::get('/setting', [ApiOperatorController::class, 'setting']);
        Route::put('/setting', [ApiOperatorController::class, 'updateSetting']);
    });
});

