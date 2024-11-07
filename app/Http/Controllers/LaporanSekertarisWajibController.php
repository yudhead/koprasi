<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\PembayaranWajib;
use Illuminate\Http\Request;

class LaporanSekertarisWajibController extends Controller
{
    public function index(Request $request)
    {
        $query = PembayaranWajib::query();

        // Apply search if 'search' is provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nik', 'like', "%$search%");
            });
        }

        // Get all pembayaran data
        $pembayaran = $query->get();

        // Retrieve only 'nik' and 'nama' columns from Peminjaman
        $peminjaman = Peminjaman::select('nik', 'nama')->get();

        // Merge data from peminjaman into pembayaran based on 'nik'
        foreach ($pembayaran as $payment) {
            // Find corresponding peminjaman record by 'nik'
            $relatedPeminjaman = $peminjaman->where('nik', $payment->nik)->first();

            // If there is a matching peminjaman record, add the name from peminjaman
            if ($relatedPeminjaman) {
                $payment->nama = $relatedPeminjaman->nama;
            } else {
                $payment->nama = ''; // Set to empty if no matching record is found
            }
        }

        return view('layoutSekertaris.laporan-wajib', compact('pembayaran'));
    }
}