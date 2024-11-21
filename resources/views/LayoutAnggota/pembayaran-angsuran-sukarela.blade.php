@extends('LayoutAnggota.dashboard')


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
        <form action="{{ route('PembayaranSukarela.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="id_peminjaman">Pilih NIK dan Nama</label>
                <select name="id_peminjaman" id="id_peminjaman" class="form-control" required>
                    <option value="">Pilih NIK</option>
                    @foreach ($peminjamans as $peminjaman)
                        <option value="{{ $peminjaman->id_peminjaman }}"
                                data-nik="{{ $peminjaman->nik }}"
                                data-nama="{{ $peminjaman->nama }}">
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
            <a href="{{ route('PembayaranSukarela.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    // Tambahkan logika untuk mengambil data tambahan dari dropdown
    document.getElementById('id_peminjaman').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var nik = selectedOption.getAttribute('data-nik') || '';
        var nama = selectedOption.getAttribute('data-nama') || '';

        console.log("NIK:", nik);
        console.log("Nama:", nama);
    });
</script>
@endsection
