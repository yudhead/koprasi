<?php

namespace App\Http\Controllers;

use App\Models\Rekap;
use Illuminate\Http\Request;

class RekapDataPenggunaController extends Controller
{
    public function index() {
        // Ambil semua data pengguna dari database
        $rekap = Rekap::all();
        
        // Kirim data pengguna ke view
        return view('LayoutBendahara.RekapData', compact('rekap'));
    }

    public function create() {
        return view('LayoutBendahara.TambahRekap');
    }
    
    public function store(Request $request) {
        // Validasi data
        $request->validate([
            'tanggal' => 'required|date',
            'simpanan_wajib' => 'required|numeric',
            'simpanan_sukarela' => 'required|numeric',
            'pinjaman' => 'required|numeric',
            'total' => 'required|numeric',
        ]);
    
        // Simpan data rekap ke database
        Rekap::create([
            'tanggal' => $request->tanggal,
            'simpanan_wajib' => $request->simpanan_wajib,
            'simpanan_sukarela' => $request->simpanan_sukarela,
            'pinjaman' => $request->pinjaman,
            'total' => $request->total,
        ]);
    
        // Redirect ke halaman RekapData dengan pesan sukses
        return redirect()->route('rekap-data.index')->with('success', 'Data rekap berhasil ditambahkan!');
    }
    
    public function edit($id){
        // Ambil data rekap berdasarkan ID
        $rekap = Rekap::findOrFail($id);

        // Tampilkan halaman edit dengan data rekap
        return view('LayoutBendahara.EditRekap', compact('rekap'));
    }

    public function update(Request $request, $id){
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'simpanan_wajib' => 'required|numeric',
            'simpanan_sukarela' => 'required|numeric',
            'pinjaman' => 'required|numeric',
        ]);

        // Temukan data rekap berdasarkan ID dan update
        $rekap = Rekap::findOrFail($id);
        $rekap->update([
            'tanggal' => $request->tanggal,
            'simpanan_wajib' => $request->simpanan_wajib,
            'simpanan_sukarela' => $request->simpanan_sukarela,
            'pinjaman' => $request->pinjaman,
            'total' => $request->simpanan_wajib + $request->simpanan_sukarela + $request->pinjaman,
        ]);

        // Redirect kembali ke halaman rekap dengan pesan sukses
        return redirect()->route('rekap-data.index')->with('success', 'Data rekap berhasil diperbarui.');
    }

        public function destroy($id){
        // Temukan data rekap berdasarkan ID dan hapus
        $rekap = Rekap::findOrFail($id);
        $rekap->delete();

        // Redirect kembali ke halaman rekap dengan pesan sukses
        return redirect()->route('rekap-data.index')->with('success', 'Data rekap berhasil dihapus.');
    }

}
