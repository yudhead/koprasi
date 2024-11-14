<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index()
    {
        $informasis = Informasi::all();
        return view('LayoutBendahara.Informasi', compact('informasis'));
    }

    public function create()
    {
        return view('LayoutBendahara.Informasi-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'simpanan_wajib' => 'required|numeric',
            'simpanan_sukarela' => 'required|numeric',
            'simpanan_terpimpin' => 'required|numeric',
            'pinjaman' => 'required|numeric',
        ]);

        Informasi::create($request->all());

        return redirect()->route('informasi.index')->with('success', 'Data informasi berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'simpanan_wajib' => 'required|numeric',
            'simpanan_sukarela' => 'required|numeric',
            'simpanan_terpimpin' => 'required|numeric',
            'pinjaman' => 'required|numeric',
        ]);

        $informasi = Informasi::findOrFail($id);
        $informasi->update($request->all());

        return redirect()->route('informasi.index')->with('success', 'Data informasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasi->delete();

        return redirect()->route('informasi.index')->with('success', 'Data informasi berhasil dihapus');
    }
}
