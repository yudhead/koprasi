<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pengguna</title>
    <link rel="stylesheet" href="{{ asset('assets/TambahPengguna.css') }}">
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar code, similar to DataPengguna page -->
    </div>

    <div class="main-content">
        <h2>Tambah Data Pengguna</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('data-pengguna.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="input-add" required>
            </div>
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" class="input-add" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="input-add" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="input-add" required></textarea>
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telp</label>
                <input type="text" name="no_telp" id="no_telp" class="input-add" required>
            </div>
            
            <button type="submit" class="btn-add">Simpan</button>
            <button type="button" class="btn-back" onclick="window.location='{{ route('data-pengguna.index') }}'">Kembali</button>
        </form>
    </div>
</body>
</html>
