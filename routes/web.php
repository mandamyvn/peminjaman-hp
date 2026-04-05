<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\LogAktifitasController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\LaporanController;
use App\Http\Controllers\Peminjam\AlatController as PeminjamAlatController;
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPeminjamanController;
use App\Http\Controllers\Peminjam\PengembalianController as PeminjamPengembalianController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('alat', AlatController::class);
        Route::resource('peminjaman', PeminjamanController::class);
        Route::resource('pengembalian', PengembalianController::class);
        Route::get('log-aktifitas', [LogAktifitasController::class, 'index'])->name('log-aktifitas.index');
        Route::resource('log-aktifitas', \App\Http\Controllers\Admin\LogAktifitasController::class)
            ->only(['index', 'show']);
    });
    
  Route::middleware(['role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        /* ================= PEMINJAMAN ================= */
        Route::resource('peminjaman', PetugasPeminjamanController::class);

        Route::post('peminjaman/{peminjaman}/approve',
            [PetugasPeminjamanController::class, 'approve'])
            ->name('peminjaman.approve');

        Route::post('peminjaman/{peminjaman}/reject',
            [PetugasPeminjamanController::class, 'reject'])
            ->name('peminjaman.reject');

        Route::post('peminjaman/{peminjaman}/borrowed',
            [PetugasPeminjamanController::class, 'markAsBorrowed'])
            ->name('peminjaman.borrowed');

       /* ================= PENGEMBALIAN ================= */

Route::get('pengembalian',
    [PetugasPengembalianController::class, 'index']
)->name('pengembalian.index');

Route::post('pengembalian/{peminjaman}',
    [PetugasPengembalianController::class, 'store']
)->name('pengembalian.store');

Route::get('pengembalian/{pengembalian}/struk',
    [PetugasPengembalianController::class, 'struk']
)->name('pengembalian.struk');


        /* ================= LAPORAN (INI YANG HILANG) ================= */
        Route::get('laporan',
            [LaporanController::class, 'index'])
            ->name('laporan.index');

        Route::get('laporan/cetak',
            [LaporanController::class, 'cetak'])
            ->name('laporan.cetak');
    });



          

    
    Route::middleware(['role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
        Route::get('alat', [PeminjamAlatController::class, 'index'])->name('alat.index');
        Route::get('alat/{alat}', [PeminjamAlatController::class, 'show'])->name('alat.show');
        Route::get('peminjaman', [PeminjamPeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::post('peminjaman', [PeminjamPeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::get('pengembalian', [PeminjamPengembalianController::class, 'index'])->name('pengembalian.index');
        Route::post('pengembalian/{peminjaman}', [PeminjamPengembalianController::class, 'store'])->name('pengembalian.store');
        Route::get('peminjaman/{peminjaman}', [PeminjamPeminjamanController::class, 'show'])->name('peminjaman.show');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';