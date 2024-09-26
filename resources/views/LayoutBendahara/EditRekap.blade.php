@extends('LayoutBendahara.index')

@section('content')

<div class="main-content">
    <h2>Edit Rekap Data</h2>

    <!-- Tampilkan alert error jika validasi gagal -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form edit data rekap -->
    <form action="{{ route('bendahara.updateRekap', $rekap->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ $rekap->tanggal }}" required>
        </div>

        <div class="form-group">
            <label for="simpanan_wajib">Simpanan Wajib</label>
            <input type="number" id="simpanan_wajib" name="simpanan_wajib" value="{{ $rekap->simpanan_wajib }}" required>
        </div>

        <div class="form-group">
            <label for="simpanan_sukarela">Simpanan Sukarela</label>
            <input type="number" id="simpanan_sukarela" name="simpanan_sukarela" value="{{ $rekap->simpanan_sukarela }}" required>
        </div>

        <div class="form-group">
            <label for="pinjaman">Pinjaman</label>
            <input type="number" id="pinjaman" name="pinjaman" value="{{ $rekap->pinjaman }}" required>
        </div>

        <button type="submit" class="btn-add">Update Data</button>
        <a href="{{ route('bendahara.RekapData') }}" class="btn-back">Kembali</a>
    </form>
</div>

@endsection
