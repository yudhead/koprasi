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
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" value="{{ $anggota->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $anggota->email }}" required>
        </div>

        <div class="form-group">
            <label for="role_id">Role</label>
            <select name="role_id" id="role_id" required>
                <option value="1" {{ $anggota->role_id == 1 ? 'selected' : '' }}>Sekretaris</option>
                <option value="2" {{ $anggota->role_id == 2 ? 'selected' : '' }}>Pengurus</option>
                <option value="3" {{ $anggota->role_id == 3 ? 'selected' : '' }}>Anggota</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak ingin mengubah">
        </div>

        <button type="submit" class="btn-update">Update Anggota</button>
        <a href="{{ route('anggota.index') }}" class="btn-back">Kembali</a>
    </form>

</div>
@endsection
