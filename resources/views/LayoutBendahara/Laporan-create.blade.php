@extends('LayoutBendahara.index')

@section('content')
<div class="main-content">
    <div class="container">
        <h2>Tambah Data Laporan</h2>

        <!-- Form untuk tambah laporan -->
        <form action="{{ route('bendahara.laporan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama" required>
            </div>

            <div class="form-group">
                <label for="simpanan_wajib">Simpanan Wajib</label>
                <input type="number" name="simpanan_wajib" class="form-control" id="simpanan_wajib" placeholder="Masukkan simpanan wajib" required>
            </div>

            <div class="form-group">
                <label for="simpanan_sukarela">Simpanan Sukarela</label>
                <input type="number" name="simpanan_sukarela" class="form-control" id="simpanan_sukarela" placeholder="Masukkan simpanan sukarela" required>
            </div>

            <div class="form-group">
                <label for="peminjaman">Peminjaman</label>
                <input type="number" name="peminjaman" class="form-control" id="peminjaman" placeholder="Masukkan jumlah peminjaman" required>
            </div>

            <div class="form-group">
                <label for="cicilan">Cicilan</label>
                <input type="number" name="cicilan" class="form-control" id="cicilan" placeholder="Masukkan jumlah cicilan" required>
            </div>

            <div class="form-group">
                <label for="kekurangan">Kekurangan</label>
                <input type="number" name="kekurangan" class="form-control" id="kekurangan" placeholder="Masukkan kekurangan" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('bendahara.laporan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
