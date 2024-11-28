<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Peminjaman;

class PembayaranKetuaController extends Controller
{
    public function index()
    {
        // Authentication user
        $user = auth()->user();

        // Retrieve peminjaman data according to role
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutKetua.pembayaran', compact('peminjamans'));
    }


    public function create()
    {
        // Authentication
        $user = auth()->user();

            // Mengambil data peminjam yang status pinjamannya aktif dan belum lunas
            $peminjamans = Peminjaman::where('role', $user->role)
            ->where('status', 'aktif') // Status pinjaman aktif
            ->whereDoesntHave('pembayaran', function ($query) {
                $query->where('status', 'lunas'); // Pastikan pinjaman belum lunas
            })
            ->get();

        return view('LayoutKetua.pembayaran', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validasi data input
        $validated = $request->validate([
            'cicilan' => 'required|numeric',
            'id_peminjaman' => 'required|integer',
        ]);

        // Ambil data peminjaman berdasarkan nik dan id_peminjaman
        $nik = $request->input('nik');
        $id_peminjaman = $request->input('id_peminjaman');
        $peminjaman = Peminjaman::where('nik', $nik)
            ->where('id_peminjaman', $id_peminjaman)
            ->where('role', $user->role)
            ->first();

        if (!$peminjaman) {
            return redirect()->back()->withErrors(['Data peminjaman tidak ditemukan.']);
        }

        // Hitung cicilan per bulan
        $cicilan_per_bulan = $peminjaman->jumlah_pinjaman / $peminjaman->paket;

        // Validasi cicilan input
        if ($validated['cicilan'] != $cicilan_per_bulan) {
            return redirect()->back()->withErrors([
                'Jumlah cicilan harus tepat sebesar ' . number_format($cicilan_per_bulan, 2)
            ]);
        }

        // Hitung angsuran ke
        $angsuran_sebelumnya = Pembayaran::where('id_peminjaman', $id_peminjaman)->count();
        $angsuran_ke = $angsuran_sebelumnya + 1;

        // Cek apakah paket sudah selesai
        if ($angsuran_ke > $peminjaman->paket) {
            return redirect()->back()->withErrors(['Paket angsuran telah selesai.']);
        }

        // Hitung sisa kekurangan
        $lastPembayaran = Pembayaran::where('id_peminjaman', $id_peminjaman)->latest()->first();
        $totalCicilan = $lastPembayaran ? $lastPembayaran->kekurangan : $peminjaman->jumlah_pinjaman;
        $kekurangan = $totalCicilan - $validated['cicilan'];

        // Simpan pembayaran
        $validated['nik'] = $nik;
        $validated['nama'] = $peminjaman->nama;
        $validated['jumlah_pinjaman'] = $peminjaman->jumlah_pinjaman;
        $validated['paket'] = $peminjaman->paket;
        $validated['angsuran_ke'] = $angsuran_ke;
        $validated['kekurangan'] = $kekurangan;
        $validated['role'] = $user->role;
        $validated['created_by'] = $user->id;

        $pembayaran = Pembayaran::create($validated);

        if (!$pembayaran) {
            return redirect()->back()->withErrors('Pembayaran gagal disimpan.');
        }

        // Update status peminjaman jika lunas
        if ($kekurangan <= 0) {
            $peminjaman->status = 'lunas';
            $peminjaman->save();
        }

        return redirect()->route('KetuaPembayaran.index')->with('success', 'Pembayaran berhasil disimpan.');
    }
    public function getAngsuranKe($id_peminjaman)
    {
        $angsuran_sebelumnya = Pembayaran::where('id_peminjaman', $id_peminjaman)->count();
        $angsuran_ke = $angsuran_sebelumnya + 1;

        return response()->json(['angsuran_ke' => $angsuran_ke]);
    }
}
