<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\PembayaranWajib;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PembayaranWajibSekertarisController extends Controller
{
    public function index()
    {
        // Authentication user
        $user = auth()->user();

        // Retrieve peminjaman data according to role
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutSekertaris.Pembayaran-wajib', compact('peminjamans'));
    }

    public function create()
    {
        // Authentication
        $user = auth()->user();

        // Retrieve peminjaman data according to role
        $peminjamans = Peminjaman::where('role', $user->role)->get();

        return view('LayoutSekertaris.Pembayaran-wajib', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validate input data
        $validated = $request->validate([
            'simpanan_wajib' => 'required|numeric|min:15000'
        ], [
            'simpanan_wajib.min' => 'Simpanan wajib harus 15000 atau lebih.',
        ]);

            // Get the NIK from the request
            $nik = $request->input('nik');
            $peminjaman = Peminjaman::where('nik', $nik)
                ->where('role', $user->role) // Ensure the role matches
                ->latest()->first();

            // Check if a matching Peminjaman record was found
            if (!$peminjaman) {
                return redirect()->back()->withErrors(['Data peminjaman tidak ditemukan.']);
            }

            // Retrieve required data
            $id_peminjaman = $peminjaman->id_peminjaman; // Use `id_peminjaman` instead of `id`
            $nama = $peminjaman->nama; // Assuming `nama` exists in `Peminjaman` model

            // Prepare validated data for saving
            $validated['id_peminjaman'] = $id_peminjaman;
            $validated['nik'] = $nik;
            $validated['nama'] = $nama;
            $validated['simpanan_wajib'] = $validated['simpanan_wajib'];
            $validated['role'] = $user->role;
            $validated['created_by'] = $user->id;

            // Save the payment to the database
            $pembayaran = PembayaranWajib::create($validated);
            if (!$pembayaran) {
                return redirect()->back()->withErrors('Pembayaran gagal disimpan.');
            }

            return redirect()->route('sukarela.index')->with('success', 'Pembayaran berhasil disimpan.');
            }

}

