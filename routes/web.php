<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SekertarisController;
use App\Http\Controllers\TambahAnggotaController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\RekapDataPenggunaController;
use App\Http\Controllers\TambahDataPenggunaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamanBendaharaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanSekertarisController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembayaranBendaharaController;
use App\Http\Controllers\ValidasiBendaharaController;
use App\Http\Controllers\ValidasiSekertarisController;
use App\Http\Controllers\KetuaController;
use App\Http\Controllers\WakilController;
use App\Http\Controllers\ValidasiKetuaController;
use App\Http\Controllers\ValidasiWakilController;
use App\Http\Controllers\PeminjamanKetuaController;
use App\Http\Controllers\PeminjamanWakilController;
use App\Http\Controllers\LaporanKetuaController;
use App\Http\Controllers\LaporanWakilController;
use App\Http\Controllers\PembayaranKetuaController;
use App\Http\Controllers\PembayaranWakilController;
use App\Http\Controllers\PembayaranWajibSekertarisController;
use App\Http\Controllers\PembayaranSukarelaSekertarisController;
use App\Http\Controllers\LaporanSekertarisWajibController;
use App\Http\Controllers\LaporanSekertarisSukarelaController;








// Route untuk menampilkan form login (GET)
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk memproses form login (POST)
Route::post('/loginm', [LoginController::class, 'login'])->name('login.post');

// Route untuk logout (POST)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Middleware untuk melindungi route berdasarkan peran (role) Sekretaris
Route::middleware(['auth', 'role:sekertaris'])->group(function () {
    Route::get('/sekertaris/dashboard', [SekertarisController::class, 'index'])->name('sekertaris.dashboard');
    Route::get('/anggota', [TambahAnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/create', [TambahAnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota', [TambahAnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{id}/edit', [TambahAnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [TambahAnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [TambahAnggotaController::class, 'destroy'])->name('anggota.destroy');
    Route::resource('peminjaman', PeminjamanController::class);
    //Route::resource('laporan', LaporanSekertarisController::class);
    Route::get('sekertaris/laporan', [LaporanSekertarisController::class, 'index'])->name('laporan.index');
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('wajib', PembayaranWajibSekertarisController::class);
    Route::resource('sukarela', PembayaranSukarelaSekertarisController::class);
    Route::resource('LaporanWajib', LaporanSekertarisWajibController::class);
    Route::resource('LaporanSukarela', LaporanSekertarisSukarelaController::class);
    Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('sekertaris/validasi', [ValidasiSekertarisController::class, 'showValidationPage'])->name('validasi');

});

// Route untuk role 'bendahara'
Route::middleware(['auth', 'role:bendahara'])->group(function () {
    Route::get('/bendahara/dashboard', [BendaharaController::class, 'index'])->name('bendahara.dashboard');
    Route::get('/bendahara/data-pengguna', [TambahDataPenggunaController::class, 'DataPengguna'])->name('bendahara.DataPengguna');
    Route::get('bendahara/tambah-pengguna', [TambahDataPenggunaController::class, 'create'])->name('bendahara.tambahPengguna');
    Route::post('bendahara/tambah-pengguna', [TambahDataPenggunaController::class, 'store'])->name('bendahara.storePengguna');
    Route::get('/pengguna/{id}/edit', [TambahDataPenggunaController::class, 'edit'])->name('bendahara.editPengguna');
    Route::delete('/pengguna/{id}', [TambahDataPenggunaController::class, 'destroy'])->name('bendahara.hapusPengguna');
    Route::put('/bendahara/updatePengguna/{id}', [TambahDataPenggunaController::class, 'update'])->name('bendahara.updatePengguna');
    Route::get('/bendahara/rekap-data', [RekapDataPenggunaController::class, 'RekapData'])->name('bendahara.RekapData');
    Route::get('/bendahara/tambahRekap', [RekapDataPenggunaController::class, 'tambahRekap'])->name('bendahara.TambahRekap');
    Route::post('/bendahara/storeRekap', [RekapDataPenggunaController::class, 'storeRekap'])->name('bendahara.storeRekap');
    Route::get('/bendahara/rekap/edit/{id}', [RekapDataPenggunaController::class, 'editRekap'])->name('bendahara.EditRekap');
    Route::post('/bendahara/rekap/update/{id}', [RekapDataPenggunaController::class, 'updateRekap'])->name('bendahara.updateRekap');
    Route::delete('/bendahara/rekap/delete/{id}', [RekapDataPenggunaController::class, 'hapusRekap'])->name('bendahara.hapusRekap');
    Route::get('/bendahara/peminjaman', [PeminjamanBendaharaController::class, 'index'])->name('bendahara.peminjaman.index');
    Route::get('/bendahara/peminjaman/create', [PeminjamanBendaharaController::class, 'create'])->name('bendahara.peminjaman.create');
    Route::post('/bendahara/peminjaman/store', [PeminjamanBendaharaController::class, 'store'])->name('bendahara.peminjaman.store');
    Route::get('/bendahara/peminjaman/{id}/edit', [PeminjamanBendaharaController::class, 'edit'])->name('bendahara.peminjaman.edit');
    Route::put('/bendahara/peminjaman/{id}', [PeminjamanBendaharaController::class, 'update'])->name('bendahara.peminjaman.update');
    Route::delete('/bendahara/peminjaman/{id}', [PeminjamanBendaharaController::class, 'destroy'])->name('bendahara.peminjaman.destroy');
    Route::get('bendahara/pembayaran', [PembayaranBendaharaController::class, 'index'])->name('bendahara.pembayaran.index');
    Route::post('bendahara/pembayaran/store', [PembayaranBendaharaController::class, 'store'])->name('bendahara.pembayaran.store');
    Route::get('bendahara/laporan', [LaporanController::class, 'index'])->name('bendahara.laporan.index');
    Route::get('bendahara/validasi', [ValidasiBendaharaController::class, 'showValidationPage'])->name('bendahara.validasi');
    Route::post('/validasi/approve/{id}', [ValidasiBendaharaController::class, 'approve']);
    Route::post('/validasi/disapprove/{id}', [ValidasiBendaharaController::class, 'disapprove']);
});

// Route untuk role 'ketua'
Route::middleware(['auth', 'role:ketua'])->group(function () {
    Route::get('/ketua', [KetuaController::class, 'index'])->name('ketua.dashboard');
    Route::get('/ketua/peminjaman', [PeminjamanKetuaController::class, 'index'])->name('ketua.peminjaman.index');
    Route::get('/ketua/peminjaman/create', [PeminjamanKetuaController::class, 'create'])->name('ketua.peminjaman.create');
    Route::post('/ketua/peminjaman', [PeminjamanKetuaController::class, 'store'])->name('ketua.peminjaman.store');
    Route::get('/ketua/peminjaman/{id}/edit', [PeminjamanKetuaController::class, 'edit'])->name('ketua.peminjaman.edit');
    Route::put('/ketua/peminjaman/{id}', [PeminjamanKetuaController::class, 'update'])->name('ketua.peminjaman.update');
    Route::delete('/ketua/peminjaman/{id}', [PeminjamanKetuaController::class, 'destroy'])->name('ketua.peminjaman.destroy');
    Route::get('ketua/laporan', [LaporanKetuaController::class, 'index'])->name('ketua.laporan.index');
    Route::get('ketua/validasi', [ValidasiKetuaController::class, 'showValidationPage'])->name('ketua.validasi');
    Route::post('/validasi/approve/{id}', [ValidasiKetuaController::class, 'approve']);
    Route::post('/validasi/disapprove/{id}', [ValidasiKetuaController::class, 'disapprove']);
    Route::get('ketua/pembayaran', [PembayaranKetuaController::class, 'index'])->name('ketua.pembayaran.index');
    Route::post('ketua/pembayaran/store', [PembayaranKetuaController::class, 'store'])->name('ketua.pembayaran.store');
});

// Route untuk role 'wakil_ketua'
Route::middleware(['auth', 'role:wakil_ketua'])->group(function () {
    Route::get('/wakil', [WakilController::class, 'index'])->name('wakil_ketua.dashboard');
    Route::get('/wakil/peminjaman', [PeminjamanWakilController::class, 'index'])->name('wakil_ketua.peminjaman.index');
    Route::get('/wakil/peminjaman/create', [PeminjamanWakilController::class, 'create'])->name('wakil_ketua.peminjaman.create');
    Route::post('/wakil/peminjaman', [PeminjamanWakilController::class, 'store'])->name('wakil_ketua.peminjaman.store');
    Route::get('/wakil/peminjaman/{id}/edit', [PeminjamanWakilController::class, 'edit'])->name('wakil_ketua.peminjaman.edit');
    Route::put('/wakil/peminjaman/{id}', [PeminjamanWakilController::class, 'update'])->name('wakil_ketua.peminjaman.update');
    Route::delete('/wakil/peminjaman/{id}', [PeminjamanWakilController::class, 'destroy'])->name('wakil_ketua.peminjaman.destroy');
    Route::get('wakil/laporan', [LaporanWakilController::class, 'index'])->name('wakil_ketua.laporan.index');
    Route::get('wakil/validasi', [ValidasiWakilController::class, 'showValidationPage'])->name('wakil_ketua.validasi');
    Route::post('/validasi/approve/{id}', [ValidasiWakilController::class, 'approve']);
    Route::post('/validasi/disapprove/{id}', [ValidasiWakilController::class, 'disapprove']);
    Route::get('wakil/pembayaran', [PembayaranWakilController::class, 'index'])->name('wakil_ketua.pembayaran.index');
    Route::post('wakil/pembayaran/store', [PembayaranWakilController::class, 'store'])->name('wakil_ketua.pembayaran.store');
});

// Route untuk role 'anggota'
Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/anggota/dashboard', [AnggotaController::class, 'index'])->name('anggota.dashboard');
});





// Route::middleware(['auth', 'role:' . Role::SEKERTARIS])->group(function () {
//     Route::get('/sekretaris', [SekertarisController::class, 'index']);
// });
