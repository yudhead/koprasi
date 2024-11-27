<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Menampilkan daftar semua peminjaman
        $peminjaman = Peminjaman::with('pembayarans')
            ->selectRaw('*, (SELECT COUNT(*) FROM peminjaman p WHERE p.nik = peminjaman.nik) as loan_count')
            ->get();
        return view('LayoutSekertaris.peminjaman-index', compact('peminjaman'));
    }

    public function create()
    {
        return view('LayoutSekertaris.peminjaman');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validasi data
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_telp' => 'required',
            'jumlah_pinjaman' => 'required|numeric|min:1',
            'jumlah_angsuran' => 'required|numeric|min:1',
            'unduhan_pengajuan' => 'nullable|mimes:pdf',
            'upload_pengajuan' => 'nullable|mimes:pdf',
            'paket' => 'required|in:3,6,12',
        ]);

        // Cek apakah ada cicilan aktif
        $cicilanAktif = Peminjaman::where('nik', $request->nik)
            ->where('status', 'aktif')
            ->exists();

        if ($cicilanAktif) {
            return redirect()->back()->withErrors(['nik' => 'Lunasi peminjaman sebelumnya terlebih dahulu.'])->withInput();
        }

        // Simpan data peminjaman
        $peminjaman = new Peminjaman();
        $peminjaman->nama = $request->nama;
        $peminjaman->nik = $request->nik;
        $peminjaman->tanggal_lahir = $request->tanggal_lahir;
        $peminjaman->alamat = $request->alamat;
        $peminjaman->no_telp = $request->no_telp;
        $peminjaman->jumlah_pinjaman = $request->jumlah_pinjaman;
        $peminjaman->jumlah_angsuran = $request->jumlah_angsuran;
        $peminjaman->paket = $request->paket;
        $peminjaman->status = 'aktif'; // Status default untuk pinjaman baru
        $peminjaman->role = $user->role;

        // Upload file jika ada
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

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function updateStatusPeminjaman($idPeminjaman)
    {
        $peminjaman = Peminjaman::with('pembayarans')->find($idPeminjaman);

        if (!$peminjaman) {
            return;
        }

        // Hitung total pembayaran
        $totalBayar = $peminjaman->pembayarans->sum('jumlah_bayar');

        // Hitung kekurangan
        $totalKekurangan = $peminjaman->jumlah_pinjaman - $totalBayar;

        // Update status berdasarkan kekurangan
        if ($totalKekurangan <= 0) {
            $peminjaman->status = 'lunas';
        } else {
            $peminjaman->status = 'aktif';
        }

        $peminjaman->save();
    }
}
