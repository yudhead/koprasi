<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        // $peminjaman = Peminjaman::all();
        $peminjaman = Peminjaman::selectRaw('*, (SELECT COUNT(*) FROM peminjaman p WHERE p.nik = peminjaman.nik) as loan_count')
        ->get();
        return view('LayoutSekertaris.peminjaman-index', compact('peminjaman'));
    }

    public function create()
    {
        return view('LayoutSekertaris.peminjaman');
    }

    public function store(Request $request)
{
    $user = auth()->user(); // Mendapatkan pengguna yang sedang login

    $request->validate([
        'nama' => 'required',
        'nik' => 'required',
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
    $peminjaman->role = $user->role; // Menyimpan role pengguna

    if ($request->hasFile('unduhan_pengajuan')) {
        $file = $request->file('unduhan_pengajuan');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $peminjaman->unduhan_pengajuan = 'uploads/' . $filename;
    }

    if ($request->hasFile('upload_pengajuan')) {
        $file = $request->file('upload_pengajuan');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $peminjaman->upload_pengajuan = 'uploads/' . $filename;
    }

    $peminjaman->save();

    return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan');
}

    public function edit($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    return view('LayoutSekertaris.peminjaman-edit', compact('peminjaman'));
}

public function update(Request $request, $id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    $request->validate([
        'nama' => 'required',
        'nik' => 'required|unique:Peminjaman,nik,' . $peminjaman->id,
        'tanggal_lahir' => 'required',
        'alamat' => 'required',
        'no_telp' => 'required',
        'jumlah_pinjaman' => 'required|numeric',
        'jumlah_angsuran' => 'required|numeric',
        'unduhan_pengajuan' => 'nullable|mimes:pdf',
        'upload_pengajuan' => 'nullable|mimes:pdf',
    ]);

    $peminjaman->nama = $request->input('nama');
    $peminjaman->nik = $request->input('nik');
    $peminjaman->tanggal_lahir = $request->input('tanggal_lahir');
    $peminjaman->alamat = $request->input('alamat');
    $peminjaman->no_telp = $request->input('no_telp');
    $peminjaman->jumlah_pinjaman = $request->input('jumlah_pinjaman');
    $peminjaman->jumlah_angsuran = $request->input('jumlah_angsuran');

    if ($request->hasFile('unduhan_pengajuan')) {
        // Delete old file if exists
        if ($peminjaman->unduhan_pengajuan) {
            unlink(public_path($peminjaman->unduhan_pengajuan));
        }

        $file = $request->file('unduhan_pengajuan');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $peminjaman->unduhan_pengajuan = 'uploads/' . $filename;
    }

    if ($request->hasFile('upload_pengajuan')) {
        // Delete old file if exists
        if ($peminjaman->upload_pengajuan) {
            unlink(public_path($peminjaman->upload_pengajuan));
        }

        $file = $request->file('upload_pengajuan');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $peminjaman->upload_pengajuan = 'uploads/' . $filename;
    }

    $peminjaman->save();

    return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui');
}

public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Hapus file yang diupload jika ada dan file tersebut eksis
        if ($peminjaman->unduhan_pengajuan && file_exists(public_path($peminjaman->unduhan_pengajuan))) {
            unlink(public_path($peminjaman->unduhan_pengajuan));
        }

        if ($peminjaman->upload_pengajuan && file_exists(public_path($peminjaman->upload_pengajuan))) {
            unlink(public_path($peminjaman->upload_pengajuan));
        }

        $peminjaman->delete();

        return redirect()->route('bendahara.peminjaman.index')->with('success', 'Peminjaman berhasil dihapus');
    }

}
