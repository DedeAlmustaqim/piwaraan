<?php

use App\Http\Controllers\PendataanController;
use App\Http\Controllers\Service\LokasiController;
use App\Http\Controllers\Service\StakeholderController;
use App\Http\Controllers\ValidasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('service')->group(function () {
    Route::get('/kecamatan', [LokasiController::class, 'getKecamatanJson']);
    Route::get('/desa/{id}', [LokasiController::class, 'getDesaJson']);
    Route::get('/stakeholder', [StakeholderController::class, 'getStakholder']);
});

Route::prefix('pendataan')->group(function () {
    Route::post('/', [PendataanController::class, 'store']);
    Route::put('/{id}', [PendataanController::class, 'update']);
    Route::delete('/{id}', [PendataanController::class, 'destroy']);
});

Route::prefix('validasi')->group(function () {
    Route::get('/', [ValidasiController::class, 'index']);
    Route::get('/get_all', [ValidasiController::class, 'getDataAll']);
    Route::post('/{id}', [ValidasiController::class, 'update']);
    Route::delete('/{id}', [ValidasiController::class, 'destroy']);
});


