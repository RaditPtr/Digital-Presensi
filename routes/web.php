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

        //Routes Walikelas
        Route::prefix('dashboard')->middleware(['akses:walikelas'])->group(function () {
            Route::prefix('/walikelas')->group(function () {
                Route::get('/', [DashboardController::class, 'jumlahData']);
                Route::prefix('siswa')->group(function () {
                    Route::get('/', [WaliKelasController::class, 'indexSiswa']);
                    Route::get('/tambah', [WaliKelasController::class, 'createSiswa']);
                    Route::post('/simpan', [WaliKelasController::class, 'storeSiswa']);
                    Route::delete('/hapus', [WaliKelasController::class, 'destroySiswa']);
                    Route::get('/edit/{id}', [WaliKelasController::class, 'editSiswa']);
                    Route::post('/edit/simpan', [WaliKelasController::class, 'updateSiswa']);
                });
                Route::get('/kelas', [WaliKelasController::class, 'indexKelas']);
                Route::get('/presensi', [WaliKelasController::class, 'indexPresensiSiswa']);
            });
            
        });

        //Routes Tatausaha
        Route::prefix('dashboard')->middleware(['akses:gurupiket'])->group(function () {
            Route::prefix('/gurupiket')->group(function () {
                Route::get('/', [DashboardController::class, 'jumlahData']);
                Route::get('/siswa', [GuruPiketController::class, 'indexSiswa']);
                Route::get('/kelas', [GuruPiketController::class, 'indexKelas']);
                Route::prefix('/presensi')->group(function () {
                    Route::get('/', [GuruPiketController::class,'indexPresensi']);
                    Route::get('/tambah', [GuruPiketController::class, 'createPresensi']);
                    Route::get('/simpan', [GuruPiketController::class, 'storePresensi']);
                    Route::delete('/hapus', [GuruPiketController::class, 'destroyPresensi']);
                    Route::get('/edit/{id}', [GuruPiketController::class, 'editPresensi']);
                    Route::post('/edit/simpan', [GuruPiketController::class, 'updatePresensi']);
                    Route::get('/detail/{id}', [GuruPiketController::class, 'detailPresensi']);
                });
                
            });
            
        });

        Route::prefix('dashboard')->middleware(['akses:gurubk'])->group(function () {
            Route::get('/gurubk', [DashboardController::class, 'jumlahData']);
        });

        Route::prefix('dashboard')->middleware(['akses:siswa'])->group(function () {
            Route::get('/siswa', [DashboardController::class, 'jumlahData']);
        });

        Route::prefix('dashboard')->middleware(['akses:penguruskelas'])->group(function () {
            Route::get('/penguruskelas', [DashboardController::class, 'jumlahData']);
        });
    
    // 


    //Siswa/
    

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
});

