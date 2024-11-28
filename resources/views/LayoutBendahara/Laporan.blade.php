@extends('LayoutBendahara.index')

<div class="main-content">
    <div class="container">
        <h2>Data Laporan Pembayaran Angsuran</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Pencarian -->
        <form action="{{ route('laporan.index') }}" method="GET" class="form-inline mb-3">
            <input type="text" name="search" class="form-control mr-2" placeholder="Cari Nama atau NIK" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        @if($pembayaran->isEmpty())
            <p>Tidak ada data pembayaran tersedia.</p>
        @else
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Cicilan</th>
                        <th>Kekurangan</th>
                        <th>Tanggal Input</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>Rp.{{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</td>
                            <td>Rp.{{ number_format($item->cicilan, 0, ',', '.') }}</td>
                            <td>Rp.{{ number_format($item->kekurangan, 0, ',', '.') }}</td>
                            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
