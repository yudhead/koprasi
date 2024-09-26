@extends('LayoutBendahara.index')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="main-content">

 <!-- Alert Sukses -->
 @if(session('success'))
 <div class="alert alert-success">
     {{ session('success') }}
 </div>
 @endif

<!-- Ubah tombol agar diarahkan ke route untuk tambah rekap -->
<button class="btn-add" onclick="location.href='{{ route('bendahara.TambahRekap') }}'">Tambah Rekap Data</button>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Simpanan Wajib</th>
            <th>Simpanan Sukarela</th>
            <th>Pinjaman</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rekap as $index => $data)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $data->tanggal }}</td>
            <td>Rp.{{ number_format($data->simpanan_wajib, 0, ',', '') }}</td>
            <td>Rp.{{ number_format($data->simpanan_sukarela, 0, ',', '') }}</td>
            <td>Rp.{{ number_format($data->pinjaman, 0, ',', '') }}</td>
            <td>Rp.{{ number_format($data->total, 0, ',', '') }}</td>
            <td>
                <!-- Tombol Edit -->
                <a href="{{ route('bendahara.EditRekap', $data->id) }}" class="btn-edit">Edit</a>

                <!-- Form untuk Hapus -->
                <form id="delete-form-{{ $data->id }}" action="{{ route('bendahara.hapusRekap', $data->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-delete" onclick="confirmDelete('{{ $data->id }}')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus data ini?',
            text: "Anda tidak akan bisa mengembalikan data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya, hapus!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endsection
