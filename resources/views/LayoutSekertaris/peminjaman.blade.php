@extends('LayoutSekertaris.layouts')

@section('content')
<div class="main-content">
    <div class="container">
        <h2>Form Peminjaman</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
            </div>

            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" class="form-control" id="nik" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" id="alamat" required></textarea>
            </div>

            <div class="form-group">
                <label for="no_telp">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control" id="no_telp" required>
            </div>

            <div class="form-group">
                <label for="paket">Pilih Paket</label>
                <select name="paket" id="paket" class="form-control" required>
                    <option value="">Pilih Paket</option>
                    <option value="3">3 Bulan</option>
                    <option value="6">6 Bulan</option>
                    <option value="12">12 Bulan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah_pinjaman">Jumlah Pinjaman</label>
                <input type="number" name="jumlah_pinjaman" class="form-control" id="jumlah_pinjaman" readonly required>
            </div>

            <div class="form-group">
                <label for="jumlah_angsuran">Jumlah Angsuran</label>
                <input type="number" name="jumlah_angsuran" class="form-control" id="jumlah_angsuran" readonly required>
            </div>

            <div class="form-group">
                <label for="upload_pengajuan">Upload Pengajuan</label>
                <input type="file" name="upload_pengajuan" class="form-control" id="upload_pengajuan" accept=".pdf">
            </div>

            <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    document.getElementById('paket').addEventListener('change', function() {
        const paket = this.value;
        let jumlahPinjaman = 0;
        let jumlahAngsuran = 0;

        if (paket === '3') {
            jumlahPinjaman = 1500000;
            jumlahAngsuran = 500000;
        } else if (paket === '6') {
            jumlahPinjaman = 3000000;
            jumlahAngsuran = 500000;
        } else if (paket === '12') {
            jumlahPinjaman = 10000000;
            jumlahAngsuran = 833000;
        }

        document.getElementById('jumlah_pinjaman').value = jumlahPinjaman;
        document.getElementById('jumlah_angsuran').value = jumlahAngsuran;
    });
</script>
@endsection
