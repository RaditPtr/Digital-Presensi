<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\PresensiSiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\SiswaController;

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

// Testing Login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
});

Route::get('/home', function () {
    return redirect('dashboard');
});

    Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'jumlahData']);
    Route::get('/dashboard/tambah', [DashboardController::class, 'create']);
    Route::post('/dashboard/simpan', [DashboardController::class, 'store']);
    Route::delete('/dashboard/hapus', [DashboardController::class, 'destroy']);
    Route::get('/dashboard/edit/{id}', [DashboardController::class, 'edit']);
    Route::post('/dashboard/edit/simpan', [DashboardController::class, 'update']);


    //Siswa/
    Route::get('/dashboard/siswa', [WaliKelasController::class, 'indexSiswa']);
    Route::get('/dashboard/siswa/tambah', [WaliKelasController::class, 'createSiswa']);
    Route::post('/dashboard/siswa/simpan', [WaliKelasController::class, 'storeSiswa']);
    Route::delete('/dashboard/siswa/hapus', [WaliKelasController::class, 'destroySiswa']);
    Route::get('/dashboard/siswa/edit/{id}', [WaliKelasController::class, 'editSiswa']);
    Route::post('/dashboard/siswa/edit/simpan', [WaliKelasController::class, 'updateSiswa']);
    Route::get('/dashboard/kelas', [WaliKelasController::class, 'indexKelas']);
    Route::get('/dashboard/presensi', [WaliKelasController::class, 'indexPresensiSiswa']);


    Route::get('/logout', [AuthController::class, 'logout']);

    Route::prefix('/logs')->group(function () {
        Route::get('/', [LogsController::class, 'index']);
    });
});

