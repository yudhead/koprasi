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
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\PeminjamanAnggota;
use App\Http\Controllers\PembayaranSukarelaAnggotaController;
use App\Http\Controllers\PembayaranWajibAnggotaController;
use App\Http\Controllers\PembayaranAnggotaController;
use App\Http\Controllers\LaporanAnggotaController;
use App\Http\Controllers\LaporanAnggotaSukarela;
use App\Http\Controllers\LaporanAnggotaWajib;
use App\Http\Controllers\LaporanSukarelaController;
use App\Http\Controllers\LaporanWajibController;
use App\Http\Controllers\PembayaranWajibBendaharaController;
use App\Http\Controllers\PembayaranSukarelaBendaharaController;
use App\Http\Controllers\LaporanKetuaWajibController;
use App\Http\Controllers\LaporanKetuaSukarelaController;
use App\Http\Controllers\PembayaranSukarelaKetuaController;
use App\Http\Controllers\PembayaranWajibKetuaController;
use App\Http\Controllers\LaporanWakilSukarelaController;
use App\Http\Controllers\LaporanWakilWajibController;
use App\Http\Controllers\PembayaranWajibWakilController;
use App\Http\Controllers\PembayaranSukarelaWakilController;
use App\Http\Controllers\InformasiKetuaController;
use App\Http\Controllers\InformasiWakilController;
use App\Http\Controllers\InformasiSekertarisController;


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
    Route::resource('LaporanWajib', LaporanSekertarisWajibController::class);
    Route::resource('LaporanSukarela', LaporanSekertarisSukarelaController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('wajib', PembayaranWajibSekertarisController::class);
    Route::resource('sukarela', PembayaranSukarelaSekertarisController::class);
    Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('sekertaris/validasi', [ValidasiSekertarisController::class, 'showValidationPage'])->name('validasi');
    Route::post('sekertaris/validasi', [ValidasiSekertarisController::class, 'processValidation'])->name('sekertaris.processValidation');
    Route::get('sekertaris/validasi/test', [ValidasiSekertarisController::class, 'processValidation']);
    Route::resource('SekertarisInformasi', InformasiSekertarisController::class);
    Route::get('/pembayaran/angsuran-ke/{id_peminjaman}', [PembayaranController::class, 'getAngsuranKe']);
});

// Route untuk role 'bendahara'
Route::middleware(['auth', 'role:bendahara'])->group(function () {
    Route::get('/bendahara/dashboard', [BendaharaController::class, 'index'])->name('bendahara.dashboard');
    Route::resource('data-pengguna', TambahDataPenggunaController::class);
    Route::resource('rekap-data', RekapDataPenggunaController::class);
    Route::resource('BendaharaPeminjaman', PeminjamanBendaharaController::class);
    Route::resource('BendaharaPembayaran', PembayaranBendaharaController::class);
    Route::resource('BendaharaWajib', PembayaranWajibBendaharaController::class);
    Route::resource('BendaharaSukarela', PembayaranSukarelaBendaharaController::class);
    Route::resource('BendaharaLaporan', LaporanController::class);
    Route::resource('BendaharaLaporanSukarela', LaporanSukarelaController::class);
    Route::resource('BendaharaLaporanWajib', LaporanWajibController::class);
    Route::get('bendahara/validasi', [ValidasiBendaharaController::class, 'showValidationPage'])->name('bendahara.validasi');
    Route::post('bendahara/validasi', [ValidasiBendaharaController::class, 'processValidation'])->name('bendahara.processValidation');
    Route::get('bendahara/validasi/test', [ValidasiBendaharaController::class, 'processValidation']);
    Route::resource('BendaharaInformasi', InformasiController::class);
});

// Route untuk role 'ketua'
Route::middleware(['auth', 'role:ketua'])->group(function () {
    Route::get('/ketua', [KetuaController::class, 'index'])->name('ketua.dashboard');
    Route::resource('KetuaPeminjaman', PeminjamanKetuaController::class);
    Route::resource('KetuaLaporan', LaporanKetuaController::class);
    Route::resource('KetuaLaporanSukarela', LaporanKetuaSukarelaController::class);
    Route::resource('KetuaLaporanWajib', LaporanKetuaWajibController::class);
    Route::get('ketua/validasi', [ValidasiKetuaController::class, 'showValidationPage'])->name('ketua.validasi');
    Route::post('ketua/validasi', [ValidasiKetuaController::class, 'processValidation'])->name('ketua.processValidation');
    Route::get('ketua/validasi/test', [ValidasiKetuaController::class, 'processValidation']);
    Route::resource('KetuaPembayaran', PembayaranKetuaController::class);
    Route::resource('KetuaWajib', PembayaranWajibKetuaController::class);
    Route::resource('KetuaSukarela', PembayaranSukarelaKetuaController::class);
    Route::resource('KetuaInformasi', InformasiKetuaController::class);
});

// Route untuk role 'wakil_ketua'
Route::middleware(['auth', 'role:wakil_ketua'])->group(function () {
    Route::get('/wakil', [WakilController::class, 'index'])->name('wakil_ketua.dashboard');
    Route::resource('WakilPeminjaman', PeminjamanWakilController::class);
    Route::resource('WakilLaporan', LaporanWakilController::class);
    Route::resource('WakilLaporanSukarela', LaporanWakilSukarelaController::class);
    Route::resource('WakilLaporanWajib', LaporanWakilWajibController::class);
    Route::get('wakil/validasi', [ValidasiWakilController::class, 'showValidationPage'])->name('wakil_ketua.validasi');
    Route::post('wakil/validasi', [ValidasiWakilController::class, 'processValidation'])->name('wakil_ketua.processValidation');
    Route::get('wakil/validasi/test', [ValidasiWakilController::class, 'processValidation']);
    Route::resource('WakilPembayaran', PembayaranWakilController::class);
    Route::resource('WakilWajib', PembayaranWajibWakilController::class);
    Route::resource('WakilSukarela', PembayaranSukarelaWakilController::class);
    Route::resource('WakilInformasi', InformasiWakilController::class);
});

// Route untuk role 'anggota'
Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/anggota/dashboard', [AnggotaController::class, 'index'])->name('anggota.dashboard');
    Route::resource('PeminjamanAnggota', PeminjamanAnggota::class);
    Route::resource('PembayaranWajib', PembayaranWajibAnggotaController::class);
    Route::resource('PembayaranSukarela', PembayaranSukarelaAnggotaController::class);
    Route::resource('PembayaranAngsuran', PembayaranAnggotaController::class);
    Route::resource('LaporanAngsuran', LaporanAnggotaController::class);
    Route::resource('LaporanAngsuranWajib', LaporanAnggotaWajib::class);
    Route::resource('LaporanAngsuranSukarela', LaporanAnggotaSukarela::class);
    Route::get('/pembayaran/angsuran-ke/{id_peminjaman}', [PembayaranController::class, 'getAngsuranKe']);



});






// Route::middleware(['auth', 'role:' . Role::SEKERTARIS])->group(function () {
//     Route::get('/sekretaris', [SekertarisController::class, 'index']);
// });
