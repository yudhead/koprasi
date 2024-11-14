@extends('LayoutBendahara.index')

@section('content')

<div class="main-content">
    <h2>Data Informasi</h2>

    <a href="{{ route('informasi.create') }}" class="btn-add">Tambah Data Informasi</a>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Simpanan Wajib</th>
                <th>Simpanan Sukarela</th>
                <th>Simpanan Terpimpin</th>
                <th>Pinjaman</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($informasis as $key => $informasi)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $informasi->tanggal }}</td>
                    <td>{{ $informasi->simpanan_wajib }}</td>
                    <td>{{ $informasi->simpanan_sukarela }}</td>
                    <td>{{ $informasi->simpanan_terpimpin }}</td>
                    <td>{{ $informasi->pinjaman }}</td>
                    <td>{{ $informasi->total }}</td>
                    <td>
                        <!-- <a href="{{ route('informasi.edit', $informasi->id) }}" class="btn-edit">Edit</a> -->
                        <form action="{{ route('informasi.destroy', $informasi->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
