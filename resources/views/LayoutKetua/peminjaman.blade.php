@extends('LayoutKetua.index')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Buat Peminjaman</span>

                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('KetuaPeminjaman.store') }}" enctype="multipart/form-data">
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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Simpan') }}
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                    <a href="{{ route('KetuaPeminjaman.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                                </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
