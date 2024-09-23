@extends('LayoutSekertaris.layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('assets/layoutsekertaris.css') }}">

<div class="main-content">
    <h2>Edit Anggota</h2>

    <!-- Form untuk edit anggota -->
    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ $anggota->nama }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $anggota->email }}" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" required>
                <option value="Sekretaris" {{ $anggota->role == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                <option value="Pengurus" {{ $anggota->role == 'Pengurus' ? 'selected' : '' }}>Pengurus</option>
                <option value="Anggota" {{ $anggota->role == 'Anggota' ? 'selected' : '' }}>Anggota</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="{{ $anggota->password }}" required>
        </div>

        <button type="submit" class="btn-update">Update Anggota</button>
        <a href="{{ route('anggota.index') }}" class="btn-back">Kembali</a>
    </form>
</div>
@endsection
