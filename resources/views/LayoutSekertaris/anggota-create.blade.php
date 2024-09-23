@extends('LayoutSekertaris.layouts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('assets/layoutsekertaris.css') }}">
<div class="main-content">
    <h2>Tambah Anggota Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form tambah anggota -->
    <form action="{{ route('anggota.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role_id" id="role" class="form-control" required>
                <!-- Dynamically Populate the Roles -->
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-add">Tambah Anggota</button>
        </div>
    </form>

    <!-- Tombol kembali ke halaman manajemen anggota -->
    <button class="btn-back" onclick="location.href='{{ route('anggota.index') }}'">Kembali ke Manajemen Anggota</button>
</div>
@endsection
