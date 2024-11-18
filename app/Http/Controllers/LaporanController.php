<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::query();
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('peminjaman', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%");
            });
        }
        $pembayaran = $query->get();
        // Mengambil semua data pembayaran
        $pembayaran = Pembayaran::all();

        // Mengambil data peminjaman hanya kolom 'nik', 'nama', dan 'jumlah_pinjaman'
        $peminjaman = Peminjaman::select('nik', 'nama', 'jumlah_pinjaman')->get();

        // Gabungkan data peminjaman ke dalam pembayaran berdasarkan 'nik'
        foreach ($pembayaran as $payment) {
            // Cari data peminjaman sesuai 'nik'
            $relatedPeminjaman = $peminjaman->where('nik', $payment->nik)->first();

            // Jika ada peminjaman yang cocok, tambahkan jumlah_pinjaman dan nama ke pembayaran
            if ($relatedPeminjaman) {
                $payment->jumlah_pinjaman = $relatedPeminjaman->jumlah_pinjaman;
                $payment->nama = $relatedPeminjaman->nama; // Tambahkan nama
            } else {
                $payment->jumlah_pinjaman = 0; // Jika tidak ditemukan, set ke 0
                $payment->nama = ''; // Set nama ke string kosong jika tidak ditemukan
            }
        }

        return view('LayoutBendahara.Laporan', compact('pembayaran'));
    }
}
