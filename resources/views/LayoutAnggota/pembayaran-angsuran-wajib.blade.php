@extends('LayoutAnggota.dashboard')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="main-content">
    <div class="container">
        <h2>Form Pembayaran Wajib</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form untuk pembayaran -->
        <form action="#" method="POST">
            @csrf

            <div class="form-group">
                <label for="nik">Pilih NIK</label>
                <select name="nik" id="nik" class="form-control" required>
                    <option value="">Pilih NIK</option>
                    @foreach ($peminjamans as $peminjaman)
                        <option value="{{ $peminjaman->nik }}"
                                data-id-peminjaman="{{ $peminjaman->id_peminjaman }}"
                                data-jumlah="{{ $peminjaman->jumlah_pinjaman }}">
                            {{ $peminjaman->nik }} - {{ $peminjaman->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="id_peminjaman" id="id_peminjaman">
            <div class="form-group">
                <label for="simpanan_wajib">simpanan wajib</label>
                <input type="number" name="simpanan_wajib" class="form-control" id="simpanan_wajib" placeholder="Masukkan jumlah simpanan wajib" required>
            </div>

            <button type="submit" class="btn btn-primary">Bayar</button>
            <a href="{{ route('wajib.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>


<script>
    document.getElementById('nik').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];

        // Ambil data id_peminjaman dan jumlah_pinjaman dari opsi yang dipilih
        var idPeminjaman = selectedOption.getAttribute('data-id-peminjaman');
        var jumlahPinjaman = selectedOption.getAttribute('data-jumlah');

        // Set nilai id_peminjaman dan jumlah_pinjaman ke input terkait
        document.getElementById('id_peminjaman').value = idPeminjaman ? idPeminjaman : '';
        document.getElementById('jumlah_pinjaman').value = jumlahPinjaman ? jumlahPinjaman : '';
    });
</script>
@endsection
