<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidasiSekertarisController extends Controller
{
    // Menampilkan halaman validasi
    public function showValidationPage()
    {
        // Ambil semua data peminjaman
        $peminjamans = Peminjaman::all();
        return view('LayoutSekertaris.validasi', compact('peminjamans'));
    }

    // Proses validasi peminjaman
    public function processValidation(Request $request)
{
    $action = $request->input('action'); // 'approve' atau 'disapprove'
    $selected = $request->input('selected'); // Array ID yang dipilih

    if (!$selected || empty($selected)) {
        return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
    }

    foreach ($selected as $id_peminjaman) {
        $peminjaman = Peminjaman::findOrFail($id_peminjaman); // Gunakan id_peminjaman
        $status = $action === 'approve' ? 'disetujui' : 'tidak disetujui';

        // Sesuaikan status berdasarkan peran yang sedang login
        if (Auth::user()->role->name == 'bendahara') {
            $peminjaman->bendahara_status = $status;
        } elseif (Auth::user()->role->name == 'ketua') {
            $peminjaman->ketua_status = $status;
        } elseif (Auth::user()->role->name == 'wakil_ketua') {
            $peminjaman->wakil_ketua_status = $status;
        } elseif (Auth::user()->role->name == 'sekertaris') {
            $peminjaman->sekertaris_status = $status;
        } elseif (Auth::user()->role->name == 'pengawas') {
            $peminjaman->pengawas_status = $status;
        } else {
            // Jika role tidak cocok
            return redirect()->back()->with('error', 'Role Anda tidak sesuai untuk melakukan validasi.');
        }

        $peminjaman->save();
    }

    return redirect()->route('sekertaris.validasi')->with('success', 'Status peminjaman berhasil diperbarui.');
}

}
