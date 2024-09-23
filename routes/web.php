<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SekertarisController;
use App\Http\Controllers\TambahAnggotaController;
use App\Http\Controllers\AnggotaController;

// Route untuk menampilkan form login (GET)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

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
});

// Route untuk role 'anggota'
Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/anggota/dashboard', [AnggotaController::class, 'index'])->name('anggota.dashboard');
});





// Route::middleware(['auth', 'role:' . Role::SEKERTARIS])->group(function () {
//     Route::get('/sekretaris', [SekertarisController::class, 'index']);
// });
