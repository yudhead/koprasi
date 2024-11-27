<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\PembayaranWajib;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PembayaranWajibBendaharaController extends Controller
{
    public function index()
    {
        // Authentication user
        $user = auth()->user();

        // Retrieve peminjaman data according to role
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutBendahara.pembayaran-wajib', compact('peminjamans'));
    }

    public function create()
    {
        // Authentication
        $user = auth()->user();

        // Retrieve peminjaman data according to role
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutBendahara.pembayaran-wajib', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validasi data input
        $validated = $request->validate([
            'simpanan_wajib' => 'required|numeric|min:15000',
            'id_peminjaman' => 'required|integer', // Tambahkan validasi untuk `id_peminjaman`
            'nik' => 'required|string', // Pastikan `nik` divalidasi
        ], [
            'simpanan_wajib.min' => 'Simpanan wajib harus 15000 atau lebih.',
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

        // Siapkan data untuk disimpan
        $validated['nik'] = $nik;
        $validated['id_peminjaman'] = $id_peminjaman;
        $validated['nama'] = $nama;
        $validated['role'] = $user->role;
        $validated['created_by'] = $user->id;

        // Simpan data pembayaran ke database
        $pembayaran = PembayaranWajib::create($validated);
        if (!$pembayaran) {
            return redirect()->back()->withErrors('Pembayaran gagal disimpan.');
        }

        return redirect()->route('BendaharaWajib.index')->with('success', 'Pembayaran berhasil disimpan.');
    }
}
