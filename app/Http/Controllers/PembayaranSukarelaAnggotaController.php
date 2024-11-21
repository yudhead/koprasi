<?php

namespace App\Http\Controllers;

use App\Models\PembayaranSukarela;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PembayaranSukarelaAnggotaController extends Controller
{
    public function index()
    {
        // Ambil data peminjaman berdasarkan role user yang login
        $user = auth()->user();
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutAnggota.Pembayaran-Angsuran-sukarela', compact('peminjamans'));
    }

    public function create()
    {
        // Ambil data peminjaman berdasarkan role user yang login
        $user = auth()->user();
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutAnggota.Pembayaran-Angsuran-sukarela', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validasi data input
        $validated = $request->validate([
            'sukarela' => 'nullable|numeric|min:0',
            'id_peminjaman' => 'required|exists:peminjaman,id_peminjaman', // Validasi `id_peminjaman`
        ]);

        // Ambil data peminjaman berdasarkan `id_peminjaman` dengan role user
        $peminjaman = Peminjaman::where('id_peminjaman', $validated['id_peminjaman'])
            ->where('role', $user->role)
            ->first();

        if (!$peminjaman) {
            return redirect()->back()->withErrors(['Data peminjaman tidak ditemukan atau tidak sesuai role.']);
        }

        // Siapkan data untuk disimpan
        $dataToSave = [
            'id_peminjaman' => $peminjaman->id_peminjaman,
            'nik' => $peminjaman->nik,
            'sukarela' => $validated['sukarela'] ?? 0,
            'role' => $user->role,
            'created_by' => $user->id,
        ];

        // Simpan data ke tabel pembayaran sukarela
        $pembayaran = PembayaranSukarela::create($dataToSave);

        if (!$pembayaran) {
            return redirect()->back()->withErrors('Pembayaran gagal disimpan.');
        }

        return redirect()->route('PembayaranSukarela.index')->with('success', 'Pembayaran berhasil disimpan.');
    }

}
