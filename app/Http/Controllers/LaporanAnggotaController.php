<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import untuk mendapatkan pengguna yang login

class LaporanAnggotaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Query dasar untuk pembayaran
        $query = Pembayaran::with('peminjaman'); // Menggunakan eager loading untuk relasi

        // Tambahkan filter berdasarkan role
        if ($user->role->name === 'anggota') { // Jika role anggota
            $query->where('created_by', $user->id); // Filter data berdasarkan user ID
        }

        // Filter pencarian jika parameter search ada
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('peminjaman', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%");
            });
        }

        // Ambil data pembayaran beserta relasi peminjaman
        $pembayaran = $query->get();

        // Proses data untuk melengkapi informasi peminjaman
        foreach ($pembayaran as $payment) {
            $relatedPeminjaman = $payment->peminjaman; // Relasi peminjaman

            if ($relatedPeminjaman) {
                // Tambahkan data peminjaman ke pembayaran
                $payment->nik = $relatedPeminjaman->nik;
                $payment->nama = $relatedPeminjaman->nama;
                $payment->jumlah_pinjaman = $relatedPeminjaman->jumlah_pinjaman;
            } else {
                // Jika tidak ada data peminjaman yang sesuai
                $payment->nik = '';
                $payment->nama = '';
                $payment->jumlah_pinjaman = 0;
            }
        }

        // Kirim data ke view
        return view('layoutAnggota.laporan-angsuran', compact('pembayaran'));
    }

}
