<?php

use App\Http\Controllers\Admin\AuditTrailController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\MasterDesaController;
use App\Http\Controllers\Admin\VerifikasiAkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CekLaporanController;
use App\Http\Controllers\Warga\DashboardController as WargaDashboardController;
use App\Http\Controllers\Warga\PelaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Gerbang Sesi — Redirect ke login jika belum autentikasi
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect()->route('login'));

/*
|--------------------------------------------------------------------------
| Halaman Publik — Cek Status Laporan (tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/cek-laporan', [CekLaporanController::class, 'index'])->name('cek-laporan');
Route::post('/cek-laporan', [CekLaporanController::class, 'cek'])->name('cek-laporan.cek');

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Inspektorat
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'check.aktif', 'role:ADMIN_INSPEKTORAT'])
    ->group(function (): void {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Verifikasi Akun
        Route::get('/verifikasi', [VerifikasiAkunController::class, 'index'])->name('verifikasi.index');
        Route::get('/verifikasi/{user}', [VerifikasiAkunController::class, 'show'])->name('verifikasi.show');
        Route::post('/verifikasi/{user}/setujui', [VerifikasiAkunController::class, 'setujui'])->name('verifikasi.setujui');
        Route::post('/verifikasi/{user}/tolak', [VerifikasiAkunController::class, 'tolak'])->name('verifikasi.tolak');

        // Master Desa — hanya index, show, edit, update (tidak ada create/store/destroy)
        Route::resource('master-desa', MasterDesaController::class)
            ->only(['index', 'show', 'edit', 'update']);

        // Laporan
        Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/export-pdf', [AdminLaporanController::class, 'exportPdf'])->name('laporan.export-pdf');
        Route::get('/laporan/{pelaporan}', [AdminLaporanController::class, 'show'])->name('laporan.show');
        Route::post('/laporan/{pelaporan}/tindak-lanjut', [AdminLaporanController::class, 'tindakLanjut'])->name('laporan.tindak-lanjut');

        // Audit Trail
        Route::get('/audit-trail', [AuditTrailController::class, 'index'])->name('audit-trail.index');
    });

/*
|--------------------------------------------------------------------------
| Warga
|--------------------------------------------------------------------------
*/
Route::prefix('warga')
    ->name('warga.')
    ->middleware(['auth', 'check.aktif', 'role:WARGA'])
    ->group(function (): void {
        Route::get('/dashboard', [WargaDashboardController::class, 'index'])->name('dashboard');
        Route::get('/laporan/buat', [PelaporanController::class, 'create'])->name('laporan.create');
        Route::post('/laporan', [PelaporanController::class, 'store'])->name('laporan.store');
        Route::get('/laporan/sukses/{kode}', [PelaporanController::class, 'sukses'])->name('laporan.sukses');
        Route::get('/laporan/{pelaporan}', [PelaporanController::class, 'show'])->name('laporan.show');
    });
