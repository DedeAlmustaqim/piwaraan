<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\FinalController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PendataanController;
use App\Http\Controllers\Service\LokasiController;
use App\Http\Controllers\Service\PotensiController;
use App\Http\Controllers\Service\StakeholderController;
use App\Http\Controllers\Stakeholder\DashboardController as StakeholderDashboardController;
use App\Http\Controllers\StakeholderController as ControllersStakeholderController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Rute publik
Route::get('/', [LandingController::class, 'index']);

Route::middleware(['auth', 'role:admin,stakeholder'])->group(function () {
    Route::get('/pendataan', [PendataanController::class, 'index']);
    Route::get('/pendataan/valid', [PendataanController::class, 'valid']);
    Route::get('/pendataan/reject', [PendataanController::class, 'reject']);
    Route::post('/pendataan/get_all', [PendataanController::class, 'getDataAll']);
    Route::get('/pendataan/get_valid', [PendataanController::class, 'getDataValid']);
    Route::get('/pendataan/get_reject', [PendataanController::class, 'getDataReject']);
    Route::get('/stakeholder', [StakeholderController::class, 'getStakholder']);

    Route::prefix('survey')->group(function () {
        Route::get('/terjadwal', [SurveyController::class, 'terjadwal']);
        Route::get('/data_survey', [SurveyController::class, 'data_survey']);
        Route::get('/get_terjadwal', [SurveyController::class, 'getTerjadwal']);
        Route::get('/get_data_survey', [SurveyController::class, 'getDataSurvey']);
    });
});

// Rute untuk Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');



    Route::prefix('validasi')->group(function () {
        Route::get('/', [ValidasiController::class, 'index']);
        Route::get('/get_all', [ValidasiController::class, 'getDataAll']);
        Route::post('/{id}', [ValidasiController::class, 'update']);
        Route::delete('/{id}', [ValidasiController::class, 'destroy']);
    });

    Route::prefix('survey')->group(function () {
        Route::get('/jadwal', [SurveyController::class, 'jadwal']);
        Route::get('/getjadwal', [SurveyController::class, 'getjadwal']);

        Route::post('/penetapan_jadwal', [SurveyController::class, 'penetapanJadwal']);
        Route::post('/finish_survey/{id}', [SurveyController::class, 'finishSurvey']);
        Route::put('/{id}', [SurveyController::class, 'update']);
        Route::delete('/{id}', [SurveyController::class, 'destroy']);
        Route::get('/lembar_survey/{id}', [SurveyController::class, 'lembar_survey']);
        Route::post('/store', [SurveyController::class, 'store']);
    });

    Route::prefix('stakeholder')->group(function () {
        Route::get('/', [ControllersStakeholderController::class, 'index']);
        Route::get('/get-stakeholder', [ControllersStakeholderController::class, 'getDatatables']);
        Route::post('/', [ControllersStakeholderController::class, 'store']);
        Route::post('/{id}', [ControllersStakeholderController::class, 'update']);
        Route::delete('/{id}', [ControllersStakeholderController::class, 'destroy']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/get-users', [UserController::class, 'getDatatables']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });
});

// Rute untuk Stakeholder
Route::middleware(['auth', 'role:stakeholder'])->group(function () {
    Route::get('/stakeholder/dashboard', [StakeholderDashboardController::class, 'index'])->name('stakeholder.dashboard');

    Route::prefix('stakeholder/pendataan')->group(function () {
        Route::get('/', [PendataanController::class, 'index']);
        Route::get('/valid', [PendataanController::class, 'valid']);
        Route::get('/reject', [PendataanController::class, 'reject']);
        Route::get('/get_all', [PendataanController::class, 'getDataAll']);
        Route::get('/get_valid', [PendataanController::class, 'getDataValid']);
        Route::get('/get_reject', [PendataanController::class, 'getDataReject']);
    });
});

// Rute untuk Operator
Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/operator/dashboard', [DashboardController::class, 'index'])->name('operator.dashboard');
    // Tambahkan rute lain untuk operator jika diperlukan
});

// Rute lainnya
Route::get('/potensi-pajak/{id}', [PotensiController::class, 'getPotensi']);
Route::get('/wajib-pajak/{id}', [PotensiController::class, 'getFinalData']);
Route::get('/wajib-pajak-all', [PotensiController::class, 'getAllFinalData']);
Route::get('/wajib-pajak-kecamatan/{id}', [PotensiController::class, 'getKecamatanFinalData']);

Route::prefix('final')->group(function () {
    Route::get('/wajib_pajak', [FinalController::class, 'index']);
    Route::get('/get_final', [FinalController::class, 'getFinal']);
});

// Rute autentikasi
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'index']);
Route::post('register', [RegisterController::class, 'register']);
Route::post('otp', [RegisterController::class, 'otp']);
Route::match(['get'], 'verifikasi/{id}', [RegisterController::class, 'verifikasi']);

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Route::match(['get', 'post'], 'otp/{parameter}', [RegisterController::class, 'otp']);

Route::prefix('service')->group(function () {
    Route::get('/stakeholder', [StakeholderController::class, 'getStakholder']);
    Route::get('/kecamatan', [LokasiController::class, 'getKecamatanJson']);
    Route::get('/desa/{id}', [LokasiController::class, 'getDesaJson']);
});
