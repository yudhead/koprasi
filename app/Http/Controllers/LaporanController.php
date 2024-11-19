<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua data pembayaran dengan relasi peminjaman
        $query = Pembayaran::with('peminjaman');

        // Filter berdasarkan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            $query->whereHas('peminjaman', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%");
            });
        }

        // Eksekusi query
        $pembayaran = $query->get();

        // Iterasi dan tambahkan data peminjaman
        foreach ($pembayaran as $payment) {
            if ($payment->peminjaman) {
                $payment->jumlah_pinjaman = $payment->peminjaman->jumlah_pinjaman;
                $payment->nama = $payment->peminjaman->nama;
            } else {
                $payment->jumlah_pinjaman = 0; // Default jika tidak ada
                $payment->nama = ''; // Default jika tidak ada
            }
        }

        return view('LayoutBendahara.Laporan', compact('pembayaran'));
    }
}

