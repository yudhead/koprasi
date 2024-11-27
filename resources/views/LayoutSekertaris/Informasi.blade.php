@extends('LayoutSekertaris.layouts')

@section('content')

<div class="main-content">
    <h2>Data Informasi</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Simpanan Wajib</th>
                <th>Simpanan Sukarela</th>
                <th>Simpanan Terpimpin</th>
                <th>Pinjaman</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($informasis as $key => $informasi)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($informasi->tanggal)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($informasi->simpanan_wajib, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($informasi->simpanan_sukarela, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($informasi->simpanan_terpimpin, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($informasi->pinjaman, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($informasi->total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
