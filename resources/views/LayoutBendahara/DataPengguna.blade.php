@extends('LayoutBendahara.index')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="main-content">
    <div class="header">
        <input type="text" placeholder="Search...">
    </div>

     <!-- Alert Sukses -->
     @if(session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
     @endif
    
    <button class="btn-add" onclick="location.href='{{ route('bendahara.tambahPengguna') }}'">Tambah Data Pengguna</button>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>No. Telp</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penggunas as $index => $pengguna)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pengguna->nama }}</td>
                <td>{{ $pengguna->nik }}</td>
                <td>{{ $pengguna->tanggal_lahir }}</td>
                <td>{{ $pengguna->alamat }}</td>
                <td>{{ $pengguna->no_telp }}</td>
               
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('bendahara.editPengguna', $pengguna->id) }}" class="btn-edit">Edit</a>
        
                    <!-- Form untuk Hapus -->
                    <form id="delete-form-{{ $pengguna->id }}" action="{{ route('bendahara.hapusPengguna', $pengguna->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button type="button" class="btn-delete" onclick="confirmDelete({{ $pengguna->id }})">Hapus</button>
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