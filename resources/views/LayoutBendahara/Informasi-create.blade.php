@extends('LayoutBendahara.index')

@section('content')

<div class="main-content">
    <h2>Tambah Data Informasi</h2>

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

    <!-- Form untuk menambahkan data informasi -->
    <form action="{{ route('informasi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" required>
        </div>

        <div class="form-group">
            <label for="simpanan_wajib">Simpanan Wajib</label>
            <input type="number" id="simpanan_wajib" name="simpanan_wajib" required>
        </div>

        <div class="form-group">
            <label for="simpanan_sukarela">Simpanan Sukarela</label>
            <input type="number" id="simpanan_sukarela" name="simpanan_sukarela" required>
        </div>

        <div class="form-group">
            <label for="simpanan_terpimpin">Simpanan Terpimpin</label>
            <input type="number" id="simpanan_terpimpin" name="simpanan_terpimpin" required>
        </div>

        <div class="form-group">
            <label for="pinjaman">Pinjaman</label>
            <input type="number" id="pinjaman" name="pinjaman" required>
        </div>

        <button type="submit" class="btn-add">Simpan Data</button>
        <a href="{{ route('informasi.index') }}" class="btn-back">Kembali</a>
    </form>
</div>

@endsection
