<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Peminjaman;

class PembayaranWakilController extends Controller
{
    public function index()
    {
        // auntentikasi user
        $user = auth()->user();

        // untuk mengambil data peminjaman sesuai role
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutWakil.pembayaran', compact('peminjamans'));
    }

    public function create()
    {
        // auntentikasi
        $user = auth()->user();

        // untuk mengambil data peminjaman sesuai role
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutWakil.pembayaran', compact('peminjamans'));
    }

    public function store(Request $request)
{
    $user = auth()->user();

    // Validasi untuk menginputkan data
    $validated = $request->validate([
        'simpanan_wajib' => 'required|numeric|min:15000',
        'simpanan_sukarela' => 'required|numeric',
        'cicilan' => 'required|numeric',
    ], [
        'simpanan_wajib.min' => 'Simpanan wajib harus 15000 atau lebih.',
    ]);

    // mengambil role dan NIK
    $nik = $request->input('nik');
    $peminjaman = Peminjaman::where('nik', $nik)
        ->where('role', $user->role) // buat agar role yang diambil sama
        ->latest()->first();

    if (!$peminjaman) {
        return redirect()->back()->withErrors('Data peminjaman tidak ditemukan.');
    }

    // menghitung kekurangan
    $jumlah_pinjaman = $peminjaman->jumlah_pinjaman;
    $kekurangan = $jumlah_pinjaman - $validated['cicilan'];

    $validated['nik'] = $peminjaman->nik;
    $validated['jumlah_pinjaman'] = $jumlah_pinjaman;
    $validated['kekurangan'] = $kekurangan;
    $validated['role'] = $user->role;
    $validated['created_by'] = $user->id; // Menambahkan kolom created_by dengan ID user

    // saving database
    $pembayaran = Pembayaran::create($validated);
    if (!$pembayaran) {
        return redirect()->back()->withErrors('Pembayaran gagal disimpan.');
    }

    return redirect()->route('wakil_ketua.pembayaran.index')->with('success', 'Pembayaran berhasil disimpan.');
}
}
