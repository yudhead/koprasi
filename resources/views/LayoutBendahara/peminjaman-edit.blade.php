@extends('LayoutBendahara.index')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Peminjaman</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('bendahara.peminjaman.update', $peminjaman->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                                <div class="col-md-6">
                                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $peminjaman->nama) }}" required autocomplete="nama" autofocus>

                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nik" class="col-md-4 col-form-label text-md-right">{{ __('NIK') }}</label>

                                <div class="col-md-6">
                                    <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik', $peminjaman->nik) }}" required autocomplete="nik">

                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                <div class="col-md-6">
                                    <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir', $peminjaman->tanggal_lahir) }}" required autocomplete="tanggal_lahir">

                                    @error('tanggal_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                                <div class="col-md-6">
                                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat', $peminjaman->alamat) }}" required autocomplete="alamat">

                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_telp" class="col-md-4 col-form-label text-md-right">{{ __('No. Telp') }}</label>

                                <div class="col-md-6">
                                    <input id="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp', $peminjaman->no_telp) }}" required autocomplete="no_telp">

                                    @error('no_telp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jumlah_pinjaman" class="col-md-4 col-form-label text-md-right">{{ __('Jumlah Pinjaman') }}</label>

                                <div class="col-md-6">
                                    <input id="jumlah_pinjaman" type="number" class="form-control @error('jumlah_pinjaman') is-invalid @enderror" name="jumlah_pinjaman" value="{{ old('jumlah_pinjaman', $peminjaman->jumlah_pinjaman) }}" required autocomplete="jumlah_pinjaman">

                                    @error('jumlah_pinjaman')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jumlah_angsuran" class="col-md-4 col-form-label text-md-right">{{ __('Jumlah Angsuran') }}</label>

                                <div class="col-md-6">
                                    <input id="jumlah_angsuran" type="number" class="form-control @error('jumlah_angsuran') is-invalid @enderror" name="jumlah_angsuran" value="{{ old('jumlah_angsuran', $peminjaman->jumlah_angsuran) }}" required autocomplete="jumlah_angsuran">

                                    @error('jumlah_angsuran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="unduhan_pengajuan" class="col-md-4 col-form-label text-md-right">{{ __('Unduhan Pengajuan') }}</label>

                                <div class="col-md-6">
                                    <input id="unduhan_pengajuan" type="file" class="form-control @error('unduhan_pengajuan') is-invalid @enderror" name="unduhan_pengajuan" value="{{ old('unduhan_pengajuan') }}">

                                    @error('unduhan_pengajuan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="upload_pengajuan" class="col-md-4 col-form-label text-md-right">{{ __('Upload Pengajuan') }}</label>

                                <div class="col-md-6">
                                    <input id="upload_pengajuan" type="file" class="form-control @error('upload_pengajuan') is-invalid @enderror" name="upload_pengajuan" value="{{ old('upload_pengajuan') }}">

                                    @error('upload_pengajuan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>

                                    <a href="{{ route('bendahara.peminjaman.index') }}" class="btn btn-secondary">
                                        {{ __('Kembali') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
