@extends('LayoutSekertaris.layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="main-content">
    <div class="container">
        <h2>Form Pembayaran Sukarela</h2>
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
        <form action="{{ route('sukarela.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nik">Pilih NIK</label>
                <select name="nik" id="nik" class="form-control" required>
                    <option value="">Pilih NIK</option>
                @foreach ($peminjamans as $peminjaman)
                    <option value="{{ $peminjaman->nik }}">
                         {{ $peminjaman->nik }} - {{ $peminjaman->nama }}
                    </option>
                @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="sukarela">Simpanan Sukarela</label>
                <input type="number" name="sukarela" class="form-control" id="sukarela" placeholder="Masukkan jumlah simpanan sukarela" step="0.01" min="0">
            </div>

            <button type="submit" class="btn btn-primary">Bayar</button>
            <a href="{{ route('sukarela.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    // Mengisi otomatis jumlah pinjaman saat NIK dipilih
    document.getElementById('nik').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var jumlahPinjaman = selectedOption.getAttribute('data-jumlah');
        document.getElementById('jumlah_pinjaman').value = jumlahPinjaman ? jumlahPinjaman : '';
    });
</script>
@endsection
