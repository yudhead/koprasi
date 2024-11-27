@extends('LayoutWakil.index')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="main-content">
<div class="container">
    <div class="mb-3">
        <h2>Data Peminjaman</h2>
        <a href="{{ route('WakilPeminjaman.create') }}" class="btn-tambahPeminjaman">+ Data Peminjaman</a>
    </div>
    <br>
    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Search...">
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>No. Telp</th>
                <th>Jumlah Pinjaman</th>
                <th>Jumlah Angsuran</th>
                <th>Total Meminjam</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->tanggal_lahir }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->no_telp }}</td>
                <td>{{ $item->jumlah_pinjaman }}</td>
                <td>{{ $item->jumlah_angsuran }}</td>
                <td>{{ $item->loan_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection

