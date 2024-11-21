<?php

namespace App\Http\Controllers;

use App\Models\PembayaranWajib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanAnggotaWajib extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Query dasar untuk pembayaran
        $query = PembayaranWajib::with('peminjaman'); // Menggunakan eager loading untuk relasi

        // Tambahkan filter berdasarkan role
        if ($user->role->name === 'anggota') { // Jika role anggota
            $query->where('created_by', $user->id); // Filter data berdasarkan user ID
        }
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
        return view('layoutAnggota.laporan-wajib', compact('pembayaran'));
    }
}
