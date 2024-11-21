<?php

namespace App\Http\Controllers;

use App\Models\PembayaranSukarela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanAnggotaSukarela extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();

        // Query dasar dengan eager loading relasi ke tabel peminjaman
        $query = PembayaranSukarela::with('peminjaman');

        if ($user->role->name === 'anggota') { // Jika role anggota
            $query->where('created_by', $user->id); // Filter data berdasarkan user ID
        }
        // Filter berdasarkan pencarian (NIK atau Nama)
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            // Gunakan whereHas untuk filter data dari tabel terkait (peminjaman)
            $query->whereHas('peminjaman', function ($q) use ($search) {
                $q->where('nik', 'like', "%$search%")
                  ->orWhere('nama', 'like', "%$search%");
            });
        }

        // Ambil data pembayaran sukarela dengan relasi peminjaman
        $pembayaran = $query->get();

        // Pastikan setiap pembayaran memiliki properti `nama` dari peminjaman
        foreach ($pembayaran as $payment) {
            $payment->nama = $payment->peminjaman ? $payment->peminjaman->nama : ''; // Jika ada relasi, ambil nama
        }

        // Kirim data ke view
        return view('layoutAnggota.laporan-sukarela', compact('pembayaran'));
    }
}
