@extends('LayoutSekertaris.layouts')

@section('content')
<div class="main-content">
    <div class="container">
        <h2>Validasi Peminjaman</h2>

        <!-- Menampilkan pesan status (success/error) -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabel data -->
        <form id="validation-form" method="POST" action="{{ route('sekertaris.processValidation') }}">
            @csrf
            <input type="hidden" name="action" id="action-input">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Ketua</th>
                        <th>Wakil Ketua</th>
                        <th>Sekertaris</th>
                        <th>Bendahara</th>
                        <th>Pengawas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $index => $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="selected[]" value="{{ $item->id_peminjaman }}">
                        </td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>Rp.{{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</td>
                        <td>{{ $item->ketua_status }}</td>
                        <td>{{ $item->wakil_ketua_status }}</td>
                        <td>{{ $item->sekertaris_status }}</td>
                        <td>{{ $item->bendahara_status }}</td>
                        <td>{{ $item->pengawas_status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tombol untuk setujui dan tidak setujui -->
            <button type="submit" name="action" value="approve" class="btn btn-success">Setujui</button>
            <button type="submit" name="action" value="disapprove" class="btn btn-danger">Tidak Setujui</button>
        </form>
    </div>
</div>

<script>
    // Validasi agar setidaknya ada satu checkbox yang dicentang
    document.getElementById('validation-form').addEventListener('submit', function (e) {
        const checkboxes = document.querySelectorAll('input[name="selected[]"]:checked');
        if (checkboxes.length === 0) {
            e.preventDefault();
            alert('Harap pilih minimal satu data.');
        }
    });
</script>

@endsection