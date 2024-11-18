<?php

namespace App\Http\Controllers;

use App\Models\PembayaranSukarela;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PembayaranSukarelaSekertarisController extends Controller
{
    public function index()
    {
        // Authentication user
        $user = auth()->user();

        // Retrieve peminjaman data according to role
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutSekertaris.Pembayaran-sukarela', compact('peminjamans'));
    }

    public function create()
    {
        // Authentication
        $user = auth()->user();

        // Retrieve peminjaman data according to role
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutSekertaris.Pembayaran-sukarela', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validate input data
        $validated = $request->validate([
            'sukarela' => 'nullable|numeric|min:0',
            'id_peminjaman' => 'required|integer' // Tambahkan validasi untuk `id_peminjaman`
        ]);

        // Get the NIK from the request
        $nik = $request->input('nik');
        $id_peminjaman = $request->input('id_peminjaman');
        $peminjaman = Peminjaman::where('nik', $nik)
            ->where('id_peminjaman', $id_peminjaman)
            ->where('role', $user->role) // Ensure the role matches
            ->latest()->first();

        // Check if a matching Peminjaman record was found
        if (!$peminjaman) {
            return redirect()->back()->withErrors(['Data peminjaman tidak ditemukan.']);
        }

        // Retrieve required data
        $nama = $peminjaman->nama; // Assuming `nama` exists in `Peminjaman` model

        // Prepare validated data for saving
        $validated['id_peminjaman'] = $id_peminjaman;
        $validated['nik'] = $nik;
        $validated['nama'] = $nama;
        $validated['sukarela'] = $validated['sukarela'] ?? 0;
        $validated['role'] = $user->role;
        $validated['created_by'] = $user->id;

        // Save the payment to the database
        $pembayaran = PembayaranSukarela::create($validated);
        if (!$pembayaran) {
            return redirect()->back()->withErrors('Pembayaran gagal disimpan.');
        }

        return redirect()->route('sukarela.index')->with('success', 'Pembayaran berhasil disimpan.');
    }
}
