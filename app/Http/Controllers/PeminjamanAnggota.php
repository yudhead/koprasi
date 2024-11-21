<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanAnggota extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Filter data berdasarkan role pengguna yang login
        $peminjaman = Peminjaman::where('role', $user->role)
            ->where('created_by', $user->id) // Hanya data yang diinput oleh pengguna ini
            ->selectRaw('*, (SELECT COUNT(*) FROM peminjaman p WHERE p.nik = peminjaman.nik) as loan_count')
            ->get();

        return view('LayoutAnggota.peminjaman-index', compact('peminjaman'));
    }


    public function create()
    {
        return view('LayoutAnggota.peminjaman-create');
    }

    public function store(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'nama' => 'required',
        'nik' => 'required|unique:peminjaman,nik',
        'tanggal_lahir' => 'required',
        'alamat' => 'required',
        'no_telp' => 'required',
        'jumlah_pinjaman' => 'required|numeric',
        'jumlah_angsuran' => 'required|numeric',
        'unduhan_pengajuan' => 'nullable|mimes:pdf',
        'upload_pengajuan' => 'nullable|mimes:pdf',
    ]);

    $peminjaman = new Peminjaman();
    $peminjaman->nama = $request->input('nama');
    $peminjaman->nik = $request->input('nik');
    $peminjaman->tanggal_lahir = $request->input('tanggal_lahir');
    $peminjaman->alamat = $request->input('alamat');
    $peminjaman->no_telp = $request->input('no_telp');
    $peminjaman->jumlah_pinjaman = $request->input('jumlah_pinjaman');
    $peminjaman->jumlah_angsuran = $request->input('jumlah_angsuran');
    $peminjaman->role = $user->role;
    $peminjaman->created_by = $user->id; // Menyimpan ID pengguna yang membuat data

    // Jika ada file yang diunggah
    if ($request->hasFile('upload_pengajuan')) {
        $file = $request->file('upload_pengajuan');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
        $peminjaman->upload_pengajuan = $fileName;
    }

    $peminjaman->save();

    return redirect()->route('PeminjamanAnggota.index')->with('success', 'Peminjaman berhasil ditambahkan');
}

}
