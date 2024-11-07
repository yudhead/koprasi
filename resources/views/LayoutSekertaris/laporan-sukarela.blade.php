@extends('LayoutSekertaris.layouts')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="main-content">
    <div class="container">
        <h2>Data Laporan Simpanan Sukarela</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(auth()->user()->role !== 'anggota')
        @if($pembayaran->isEmpty())
            <p>Tidak ada data pembayaran tersedia.</p>
        @else

            <!-- Form Pencarian -->
            <form action="{{ route('laporan.index') }}" method="GET" class="form-inline mb-3">
                <input type="text" name="search" class="form-control mr-2" placeholder="Cari Nama atau NIK" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Simpanan Sukarela</th>
                        <th>Tanggal Input</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>Rp.{{ number_format($item->sukarela, 0, ',', '.') }}</td> <!-- Display 'sukarela' -->
                            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif
        @endif
    </div>
</div>

@endsection
