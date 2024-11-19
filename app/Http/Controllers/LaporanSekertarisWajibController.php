<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\PembayaranWajib;
use Illuminate\Http\Request;

class LaporanSekertarisWajibController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar dengan relasi peminjaman
        $query = PembayaranWajib::with('peminjaman');

        // Filter pencarian berdasarkan NIK jika ada parameter search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            // Cari data berdasarkan NIK atau nama pada tabel peminjaman
            $query->whereHas('peminjaman', function ($q) use ($search) {
                $q->where('nik', 'like', "%$search%")
                  ->orWhere('nama', 'like', "%$search%");
            });
        }

        // Ambil data pembayaran wajib beserta relasi peminjaman
        $pembayaran = $query->get();

        // Proses setiap pembayaran untuk menambahkan nama peminjaman (opsional jika tidak otomatis terisi)
        foreach ($pembayaran as $payment) {
            if ($payment->peminjaman) {
                $payment->nama = $payment->peminjaman->nama;
            } else {
                $payment->nama = ''; // Jika tidak ada relasi, set nama menjadi kosong
            }
        }

        // Kirim data ke view
        return view('layoutSekertaris.laporan-wajib', compact('pembayaran'));
    }
}
