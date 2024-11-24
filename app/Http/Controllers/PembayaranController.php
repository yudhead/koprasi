<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $peminjamans = Peminjaman::where('role', $user->role)->get();
        return view('LayoutSekertaris.Pembayaran', compact('peminjamans'));
    }

    public function create()
    {
        $user = auth()->user();

        // Mengambil data peminjam yang status pinjamannya aktif dan belum lunas
        $peminjamans = Peminjaman::where('role', $user->role)
                                 ->where('status', 'aktif') // Status pinjaman aktif
                                 ->whereDoesntHave('pembayaran', function ($query) {
                                     $query->where('status', 'lunas'); // Pastikan pinjaman belum lunas
                                 })
                                 ->get();

        return view('LayoutSekertaris.Pembayaran', compact('peminjamans')); // Pastikan variabel yang dikirim sesuai
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'cicilan' => 'required|numeric',
            'id_peminjaman' => 'required|integer',
        ]);

        $nik = $request->input('nik');
        $id_peminjaman = $request->input('id_peminjaman');
        $peminjaman = Peminjaman::where('nik', $nik)
            ->where('id_peminjaman', $id_peminjaman)
            ->where('role', $user->role)
            ->first();

        if (!$peminjaman) {
            return redirect()->back()->withErrors(['Data peminjaman tidak ditemukan.']);
        }

        $angsuran_sebelumnya = Pembayaran::where('id_peminjaman', $id_peminjaman)->count();
        $angsuran_ke = $angsuran_sebelumnya + 1;

        if ($angsuran_ke > $peminjaman->paket) {
            return redirect()->back()->withErrors(['Paket angsuran telah selesai.']);
        }

        $lastPembayaran = Pembayaran::where('id_peminjaman', $id_peminjaman)->latest()->first();
        $totalCicilan = $lastPembayaran ? $lastPembayaran->kekurangan : $peminjaman->jumlah_pinjaman;

        if ($validated['cicilan'] > $totalCicilan) {
            return redirect()->back()->withErrors(['Jumlah cicilan tidak boleh lebih dari sisa kekurangan.']);
        }

        $kekurangan = $totalCicilan - $validated['cicilan'];
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
        if ($kekurangan <= 0) {
            $peminjaman->status = 'lunas';
            $peminjaman->save();
        }

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil disimpan.');
    }


    // Method tambahan untuk menghitung angsuran_ke
    public function getAngsuranKe($id_peminjaman)
    {
        $angsuran_sebelumnya = Pembayaran::where('id_peminjaman', $id_peminjaman)->count();
        $angsuran_ke = $angsuran_sebelumnya + 1;

        return response()->json(['angsuran_ke' => $angsuran_ke]);
    }
}
