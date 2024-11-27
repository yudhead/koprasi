<?php

namespace App\Http\Controllers;

use App\Models\PembayaranSukarela;
use Illuminate\Http\Request;

class LaporanSukarelaController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar dengan eager loading relasi ke tabel peminjaman
        $query = PembayaranSukarela::with('peminjaman');

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
        return view('LayoutBendahara.Laporan-sukarela', compact('pembayaran'));
    }
}
