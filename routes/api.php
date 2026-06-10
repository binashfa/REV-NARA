<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiGuruController;

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

        Route::get('/setting', [ApiGuruController::class, 'setting']);

        Route::put('/setting', [ApiGuruController::class, 'updateSetting']);
    });
});
