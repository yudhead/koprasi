@extends('LayoutAnggota.dashboard')


@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="main-content">
    <div class="container">
        <h2>Form Pembayaran Angsuran</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('PembayaranAngsuran.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nik">Pilih NIK</label>
                <select name="nik" id="nik" class="form-control" required>
                    <option value="">Pilih NIK</option>
                    @foreach ($peminjamans as $pinjam)
                        @if ($pinjam->status !== 'lunas')
                            <option value="{{ $pinjam->nik }}"
                                    data-id-peminjaman="{{ $pinjam->id_peminjaman }}"
                                    data-jumlah="{{ $pinjam->jumlah_pinjaman }}"
                                    data-paket="{{ $pinjam->paket }}">
                                {{ $pinjam->nik }} - {{ $pinjam->nama }}
                            </option>
                        @endif
                    @endforeach
                </select>

            </div>

            <input type="hidden" name="id_peminjaman" id="id_peminjaman">
            <div class="form-group">
                <label for="jumlah_pinjaman">Jumlah Pinjaman</label>
                <input type="number" name="jumlah_pinjaman" class="form-control" id="jumlah_pinjaman" placeholder="Jumlah pinjaman akan otomatis terisi" readonly>
            </div>
            <div class="form-group">
                <label for="paket">Paket (bulan)</label>
                <input type="number" name="paket" class="form-control" id="paket" placeholder="Paket akan otomatis terisi" readonly>
            </div>

            <div class="form-group">
                <label for="angsuran_ke">Angsuran Bulan Ke</label>
                <input type="number" name="angsuran_ke" class="form-control" id="angsuran_ke" placeholder="Angsuran bulan ke akan otomatis terisi" readonly>
            </div>
            <div class="form-group">
                <label for="cicilan">Cicilan</label>
                <input type="number" name="cicilan" class="form-control" id="cicilan" placeholder="Masukkan jumlah cicilan" required>
            </div>

            <button type="submit" class="btn btn-primary">Bayar</button>
            <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Batal</a>
        </form>

        <script>
            document.getElementById('nik').addEventListener('change', function () {
                var selectedOption = this.options[this.selectedIndex];
                var idPeminjaman = selectedOption.getAttribute('data-id-peminjaman');
                var jumlahPinjaman = selectedOption.getAttribute('data-jumlah');
                var paket = selectedOption.getAttribute('data-paket');

                document.getElementById('id_peminjaman').value = idPeminjaman ? idPeminjaman : '';
                document.getElementById('jumlah_pinjaman').value = jumlahPinjaman ? jumlahPinjaman : '';
                document.getElementById('paket').value = paket ? paket : '';

                fetch(`/pembayaran/angsuran-ke/${idPeminjaman}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        document.getElementById('angsuran_ke').value = data.angsuran_ke || '';
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        document.getElementById('angsuran_ke').value = '';
                    });
            });
        </script>
    </div>
</div>
@endsection
