@extends('LayoutSekertaris.layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="main-content">
    <h2>Manajemen Anggota</h2>

    <!-- Alert Sukses -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tombol untuk menambah anggota -->
    <button class="btn-add" onclick="location.href='{{ route('anggota.create') }}'">Tambah Anggota</button>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Id</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggota as $index => $member)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $member->id }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->role->name }}</td>
                <td>{{ $member->password }}</td>
                <td>
                    <!-- Tombol edit anggota -->
                    <button class="btn-edit" onclick="location.href='{{ route('anggota.edit', $member->id) }}'">
                        Edit
                    </button>

                    <!-- Tombol hapus anggota dengan SweetAlert -->
                    <form id="delete-form-{{ $member->id }}" action="{{ route('anggota.destroy', $member->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-delete" onclick="confirmDelete({{ $member->id }})">
                            Hapus
                        </button>
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
            title: 'Yakin ingin menghapus anggota ini?',
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
        })
    }
</script>

@endsection
