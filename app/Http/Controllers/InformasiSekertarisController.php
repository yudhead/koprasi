<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PembayaranWajib;
use App\Models\PembayaranSukarela;
use App\Models\Pembayaran;

class InformasiSekertarisController extends Controller
{
    public function index()
    {
        // Gabungkan data dari tabel pembayarans_wajib, pembayarans_sukarela, dan pembayarans
        $informasis = PembayaranWajib::join('pembayarans_sukarela', 'pembayarans_wajib.nik', '=', 'pembayarans_sukarela.nik')
            ->join('pembayarans', 'pembayarans_wajib.nik', '=', 'pembayarans.nik')
            ->select(
                'pembayarans_wajib.nik',
                'pembayarans_wajib.simpanan_wajib',
                'pembayarans_sukarela.sukarela as simpanan_sukarela',
                'pembayarans.jumlah_pinjaman as pinjaman',
                DB::raw('(pembayarans.jumlah_pinjaman * 0.035) as simpanan_terpimpin'),
                DB::raw('(pembayarans_wajib.simpanan_wajib + pembayarans_sukarela.sukarela + (pembayarans.jumlah_pinjaman * 0.035) + pembayarans.jumlah_pinjaman) as total'),
                'pembayarans.created_at as tanggal'
            )
            ->get();

        return view('LayoutSekertaris.Informasi', compact('informasis'));
    }
}
