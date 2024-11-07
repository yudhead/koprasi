<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ValidasiBendaharaController extends Controller
{
    public function showValidationPage()
    {
        $peminjamans = Peminjaman::all();
        return view('LayoutBendahara.validasi', compact('peminjamans'));
    }
    
    public function approve($id, Request $request)
{
    $peminjaman = Peminjaman::findOrFail($id);
    $role = $request->input('role');

    // Set status persetujuan sesuai role yang mengajukan
    switch ($role) {
        case 'ketua':
            $peminjaman->ketua_status = 'disetujui';
            break;
        case 'wakil_ketua':
            $peminjaman->wakil_ketua_status = 'disetujui';
            break;
        case 'sekertaris':
            $peminjaman->sekertaris_status = 'disetujui';
            break;
        case 'bendahara':
            $peminjaman->bendahara_status = 'disetujui';
            break;
        case 'pengawas':
            $peminjaman->pengawas_status = 'disetujui';
            break;
    }

    $peminjaman->save();

    return response()->json(['message' => 'Data disetujui'], 200);
}

public function disapprove($id, Request $request)
{
    $peminjaman = Peminjaman::findOrFail($id);
    $role = $request->input('role');

    // Set status penolakan sesuai role yang mengajukan
    switch ($role) {
        case 'ketua':
            $peminjaman->ketua_status = 'tidak disetujui';
            break;
        case 'wakil_ketua':
            $peminjaman->wakil_ketua_status = 'tidak disetujui';
            break;
        case 'sekertaris':
            $peminjaman->sekertaris_status = 'tidak disetujui';
            break;
        case 'bendahara':
            $peminjaman->bendahara_status = 'tidak disetujui';
            break;
        case 'pengawas':
            $peminjaman->pengawas_status = 'tidak disetujui';
            break;
    }

    $peminjaman->save();

    return response()->json(['message' => 'Data tidak disetujui'], 200);
}

}
