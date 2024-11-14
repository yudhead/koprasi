@extends('LayoutBendahara.index')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="mb-3">
            <h2>Data Peminjaman</h2>
            <a href="{{ route('bendahara.peminjaman.create') }}" class="btn-tambahPeminjaman">+ Data Peminjaman</a>
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
                    <th>Simpanan Wajib</th>
                    <th>Simpanan Sukarela</th>
                    <th>Aksi</th>
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
                    <td>{{ $item->simpanan_wajib }}</td>
                    <td>{{ $item->simpanan_sukarela }}</td>
                    <td>
                        <a href="#" class="btn-editPeminjaman">Edit</a>
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapusPeminjaman">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
