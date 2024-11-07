@extends('LayoutBendahara.index')

@section('content')
<div class="main-content">
    <div class="container">
        <h2>Edit Data Laporan</h2>

        <!-- Form untuk edit laporan -->
        <form action="{{ route('bendahara.laporan.update', $laporan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ $laporan->nama }}" required>
            </div>

            <div class="form-group">
                <label for="simpanan_wajib">Simpanan Wajib</label>
                <input type="number" name="simpanan_wajib" class="form-control" id="simpanan_wajib" value="{{ $laporan->simpanan_wajib }}" required>
            </div>

            <div class="form-group">
                <label for="simpanan_sukarela">Simpanan Sukarela</label>
                <input type="number" name="simpanan_sukarela" class="form-control" id="simpanan_sukarela" value="{{ $laporan->simpanan_sukarela }}" required>
            </div>

            <div class="form-group">
                <label for="peminjaman">Peminjaman</label>
                <input type="number" name="peminjaman" class="form-control" id="peminjaman" value="{{ $laporan->peminjaman }}" required>
            </div>

            <div class="form-group">
                <label for="cicilan">Cicilan</label>
                <input type="number" name="cicilan" class="form-control" id="cicilan" value="{{ $laporan->cicilan }}" required>
            </div>

            <div class="form-group">
                <label for="kekurangan">Kekurangan</label>
                <input type="number" name="kekurangan" class="form-control" id="kekurangan" value="{{ $laporan->kekurangan }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('bendahara.laporan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
