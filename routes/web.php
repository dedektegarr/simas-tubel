<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\RekomController;
use App\Http\Controllers\TubelController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/store', [AuthController::class, 'loginStore'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::resource('/', DashboardController::class);
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/pimpinan', PimpinanController::class);
    Route::get('/cetak/pimpinan', [PimpinanController::class, 'print'])->name('pimpinan.print');
    Route::patch('/pimpinan/update_status/{pimpinan}', [PimpinanController::class, 'updateStatus'])->name('pimpinan.updateStatus');

    Route::resource('/pegawai', PegawaiController::class);
    Route::get('/cetak/pegawai', [PegawaiController::class, 'print'])->name('pegawai.print');
    Route::resource('/tubel', TubelController::class);
    Route::get('/tubel/create/{pegawai}', [TubelController::class, 'createByPegawai'])->name('tubel.createByPegawai');

    Route::resource('/rekomendasi', RekomController::class);
    Route::patch('/rekomendasi/update_status/{rekomendasi}', [RekomController::class, 'updateStatus'])->name('rekomendasi.updateStatus');
    Route::get('/cetak/rekomendasi', [RekomController::class, 'print'])->name('rekomendasi.print');
    Route::get('/rekomendasi/cetak_surat/{rekomendasi}', [RekomController::class, 'cetakSurat'])->name('rekomendasi.cetakSurat');

    Route::get('/laporan/tubel', [LaporanController::class, 'laporanTubel'])->name('laporan.tubel');
    Route::post('/laporan/tubel', [LaporanController::class, 'cetakTubel'])->name('laporan.cetakTubel');
});