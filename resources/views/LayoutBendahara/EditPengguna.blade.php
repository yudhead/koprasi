<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pengguna</title>
    <link rel="stylesheet" href="{{ asset('assets/EditPengguna.css') }}">
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar code, similar to DataPengguna page -->
    </div>

    <div class="main-content">
        <h2>Edit Data Pengguna</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bendahara.updatePengguna', $pengguna->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="input-add" value="{{ $pengguna->nama }}" required>
            </div>
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" class="input-add" value="{{ $pengguna->nik }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="input-add" value="{{ $pengguna->tanggal_lahir }}" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="input-add" required>{{ $pengguna->alamat }}</textarea>
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telp</label>
                <input type="text" name="no_telp" id="no_telp" class="input-add" value="{{ $pengguna->no_telp }}" required>
            </div>

            <button type="submit" class="btn-add">Simpan</button>
            <button type="button" class="btn-back" onclick="window.location='{{ route('bendahara.DataPengguna') }}'">Kembali</button>
        </form>
    </div>
</body>
</html>
