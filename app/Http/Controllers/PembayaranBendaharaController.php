<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PembayaranBendaharaController extends Controller
{
    public function index()
    {
        // Authentication user
        $user = auth()->user();

        // Retrieve peminjaman data according to role
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutBendahara.pembayaran', compact('peminjamans'));
    }


    public function create()
    {
        // Authentication
        $user = auth()->user();

        $peminjamans = Peminjaman::where('role', $user->role)
        ->where('status', 'aktif') // Status pinjaman aktif
        ->whereDoesntHave('pembayaran', function ($query) {
            $query->where('status', 'lunas'); // Pastikan pinjaman belum lunas
        })
        ->get();

        return view('LayoutBendahara.pembayaran', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validasi data input
        $validated = $request->validate([
            'cicilan' => 'required|numeric',
            'id_peminjaman' => 'required|integer', // Tambahkan validasi untuk `id_peminjaman`
        ]);

        // Ambil NIK dan ID Peminjaman dari request
        $nik = $request->input('nik');
        $id_peminjaman = $request->input('id_peminjaman');

        // Ambil data peminjaman berdasarkan NIK dan ID Peminjaman
        $peminjaman = Peminjaman::where('nik', $nik)
            ->where('id_peminjaman', $id_peminjaman)
            ->where('role', $user->role) // Pastikan role sesuai
            ->first();

        // Cek apakah data Peminjaman ditemukan
        if (!$peminjaman) {
            return redirect()->back()->withErrors(['Data peminjaman tidak ditemukan.']);
        }

        // Ambil data yang diperlukan
        $nama = $peminjaman->nama; // Pastikan `nama` ada di model `Peminjaman`
        $jumlah_pinjaman = $peminjaman->jumlah_pinjaman;

        // Cek pembayaran terakhir jika ada
        $lastPembayaran = Pembayaran::where('id_peminjaman', $id_peminjaman)->latest()->first();

        // Hitung kekurangan
        if ($lastPembayaran) {
            $kekurangan = $lastPembayaran->kekurangan - $validated['cicilan'];
        } else {
            $kekurangan = $jumlah_pinjaman - $validated['cicilan'];
        }

        // Siapkan data untuk disimpan
        $validated['nik'] = $nik;
        $validated['nama'] = $nama;
        $validated['jumlah_pinjaman'] = $jumlah_pinjaman;
        $validated['kekurangan'] = max(0, $kekurangan); // Pastikan kekurangan tidak negatif
        $validated['role'] = $user->role;
        $validated['created_by'] = $user->id;

        // Simpan data pembayaran ke database
        $pembayaran = Pembayaran::create($validated);
        if (!$pembayaran) {
            return redirect()->back()->withErrors('Pembayaran gagal disimpan.');
        }

        return redirect()->route('BendaharaPembayaran.index')->with('success', 'Pembayaran berhasil disimpan.');
    }
    public function getAngsuranKe($id_peminjaman)
    {
        $angsuran_sebelumnya = Pembayaran::where('id_peminjaman', $id_peminjaman)->count();
        $angsuran_ke = $angsuran_sebelumnya + 1;

        return response()->json(['angsuran_ke' => $angsuran_ke]);
    }

}
