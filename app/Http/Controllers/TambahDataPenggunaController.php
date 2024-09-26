<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class TambahDataPenggunaController extends Controller
{
    public function DataPengguna() {
        // Ambil semua data pengguna dari database
        $penggunas = Pengguna::all();
        
        // Kirim data pengguna ke view
        return view('LayoutBendahara.DataPengguna', compact('penggunas'));
    }
    

    public function create() {
        // Menampilkan view untuk menambah data pengguna
        return view('LayoutBendahara.TambahPengguna');
    }

    public function store(Request $request) {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:pengguna,nik',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);
    
        // Simpan data ke database
        Pengguna::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('bendahara.DataPengguna')->with('success', 'Data pengguna berhasil ditambahkan');
    }
    
    public function update(Request $request, $id) {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:pengguna,nik,'.$id,
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);
    
        // Update data pengguna
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('bendahara.DataPengguna')->with('success', 'Data pengguna berhasil diupdate');
    }
    
   
    public function edit($id) {
        // Ambil data pengguna berdasarkan ID
        $pengguna = Pengguna::findOrFail($id);
        
        // Kirim data pengguna ke view edit
        return view('LayoutBendahara.EditPengguna', compact('pengguna'));
    }
    

    
    public function destroy($id) {
        $pengguna = Pengguna::find($id);
        $pengguna->delete();
        return redirect()->route('bendahara.DataPengguna')->with('success', 'Data pengguna berhasil dihapus');
    }
    
}
