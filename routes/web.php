<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\GuruPiketController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PresensiSiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TblUserController;

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
    //Routes Walikelas
    Route::prefix('dashboard')->middleware(['akses:walikelas,tatausaha'])->group(function () {
        Route::get('/', [DashboardController::class, 'jumlahData']);
        Route::prefix('siswa')->group(function () {
            Route::get('/', [WaliKelasController::class, 'indexSiswa']);
            Route::get('/tambah', [WaliKelasController::class, 'createSiswa']);
            Route::post('/simpan', [WaliKelasController::class, 'storeSiswa']);
            Route::delete('/hapus', [WaliKelasController::class, 'destroySiswa']);
            Route::get('/edit/{id}', [WaliKelasController::class, 'editSiswa']);
            Route::post('/edit/simpan', [WaliKelasController::class, 'updateSiswa']);
            Route::get('/detail/{id}', [WaliKelasController::class, 'detailSiswa']);
        });
        Route::prefix('pengurus')->group(function () {
            Route::get('/', [WaliKelasController::class, 'indexPengurus']);
            Route::get('/tambah', [WaliKelasController::class, 'createPengurus']);
            Route::post('/simpan', [WaliKelasController::class, 'storePengurus']);
            Route::delete('/hapus', [WaliKelasController::class, 'destroyPengurus']);
            Route::get('/edit/{id}', [WaliKelasController::class, 'editPengurus']);
            Route::post('/edit/simpan', [WaliKelasController::class, 'updatePengurus']);
        });
        Route::prefix('/akun')->group(function () {
            Route::get('/', [TblUserController::class, 'index']);
            Route::get('/tambah', [TblUserController::class, 'create']);
            Route::post('/simpan', [TblUserController::class, 'store']);
            Route::get('/edit/{id}', [TblUserController::class, 'edit']);
            Route::post('/edit/simpan', [TblUserController::class, 'update']);
            Route::delete('/hapus', [TblUserController::class, 'destroy']);
        });
        Route::prefix('/guru')->group(function () {
            Route::get('/', [GuruController::class, 'index']);
            Route::get('/tambah', [GuruController::class, 'create']);
            Route::post('/simpan', [GuruController::class, 'store']);
            Route::get('/edit/{id}', [GuruController::class, 'edit']);
            Route::post('/edit/simpan', [GuruController::class, 'update']);
            Route::delete('/hapus', [GuruController::class, 'destroy']);
        });
        Route::prefix('kelas')->group(function () {
            Route::get('/', [KelasController::class, 'indexKelas']);
            Route::get('/tambah', [KelasController::class, 'createKelas']);
            Route::post('/simpan', [KelasController::class, 'simpanKelas']);
            Route::delete('/hapus', [KelasController::class, 'destroyKelas']);
            Route::get('/edit/{id}', [KelasController::class, 'editKelas']);
            Route::post('/edit/simpan', [KelasController::class, 'updateKelas']);
            Route::get('/detail/{id}', [KelasController::class, 'detailKelas']);
        });
        Route::get('/logs', [LogsController::class, 'index']);
        Route::post('logs/hapus', [LogsController::class, 'destroy']);
        Route::get('/presensi', [WaliKelasController::class, 'indexPresensiSiswa']);
        Route::get('/presensi/edit/{id}', [WaliKelasController::class, 'editPresensi']);
        Route::post('/presensi/edit/simpan', [WaliKelasController::class, 'updatePresensi']);
    });

    //Routes Tatausaha
    // Route::prefix('dashboard')->middleware(['akses:tatausaha'])->group(function () {
    //         Route::get('/', [DashboardController::class, 'jumlahData']);
    //         Route::prefix('siswa')->group(function () {
    //             Route::get('/', [WaliKelasController::class, 'indexSiswa']);
    //             Route::get('/tambah', [WaliKelasController::class, 'createSiswa']);
    //             Route::post('/simpan', [WaliKelasController::class, 'storeSiswa']);
    //             Route::delete('/hapus', [WaliKelasController::class, 'destroySiswa']);
    //             Route::get('/edit/{id}', [WaliKelasController::class, 'editSiswa']);
    //             Route::post('/edit/simpan', [WaliKelasController::class, 'updateSiswa']);
    //             Route::get('/detail/{id}', [WaliKelasController::class, 'detailSiswa']);
    //         });
    //         Route::get('/kelas', [GuruPiketController::class, 'indexKelas']);
    //         Route::prefix('/presensi')->group(function () {
    //             Route::get('/', [GuruPiketController::class, 'indexPresensi']);
    //             Route::get('/tambah', [GuruPiketController::class, 'createPresensi']);
    //             Route::post('/simpan', [GuruPiketController::class, 'storePresensi']);
    //             Route::delete('/hapus', [GuruPiketController::class, 'destroyPresensi']);
    //             Route::get('/edit/{id}', [GuruPiketController::class, 'editPresensi']);
    //             Route::post('/edit/simpan', [GuruPiketController::class, 'updatePresensi']);
    //             Route::get('/detail/{id}', [GuruPiketController::class, 'detailPresensi']);
    //         });
    //         Route::prefix('/akun')->group(function() {
    //             Route::get('/', [TblUserController::class, 'index']);
    //             Route::get('/tambah', [TblUserController::class, 'create']);
    //             Route::post('/simpan', [TblUserController::class, 'store']);
    //             Route::get('/edit/{id}', [TblUserController::class, 'edit']);
    //             Route::post('/edit/simpan', [TblUserController::class, 'update']);
    //             Route::delete('/hapus', [TblUserController::class, 'destroy']);
    //         });
    //         Route::prefix('/guru')->group(function() {
    //             Route::get('/', [GuruController::class, 'index']);
    //             Route::get('/tambah', [GuruController::class, 'create']);
    //             Route::post('/simpan', [GuruController::class, 'store']);
    //             Route::get('/edit/{id}', [GuruController::class, 'edit']);
    //             Route::post('/edit/simpan', [GuruController::class, 'update']);
    //             Route::delete('/hapus', [GuruController::class, 'destroy']);
    //         });
    // });

    Route::prefix('dashboard')->middleware(['akses:gurubk'])->group(function () {
        Route::get('/gurubk', [DashboardController::class, 'jumlahData']);
    });

    // Route::prefix('dashboard')->middleware(['akses:siswa'])->group(function () {
    //     Route::get('/siswa', [DashboardController::class, 'jumlahData']);
    // });

    // Route::prefix('dashboard')->middleware(['akses:pengurus'])->group(function () {
    //     Route::get('/pengurus', [DashboardController::class, 'jumlahData']);
    // });






    //Siswa/
});

// Route::get('/dashboard/siswa', [WaliKelasController::class, 'indexSiswa']);
// Route::get('/dashboard/siswa/tambah', [WaliKelasController::class, 'createSiswa']);
// Route::post('/dashboard/siswa/simpan', [WaliKelasController::class, 'storeSiswa']);
// Route::delete('/dashboard/siswa/hapus', [WaliKelasController::class, 'destroySiswa']);
// Route::get('/dashboard/siswa/edit/{id}', [WaliKelasController::class, 'editSiswa']);
// Route::post('/dashboard/siswa/edit/simpan', [WaliKelasController::class, 'updateSiswa']);
// Route::get('/dashboard/kelas', [WaliKelasController::class, 'indexKelas']);
// Route::get('/dashboard/presensi', [WaliKelasController::class, 'indexPresensiSiswa']);


Route::get('/logout', [AuthController::class, 'logout']);

Route::prefix('/logs')->group(function () {
    Route::get('/', [LogsController::class, 'index']);
});
// });
