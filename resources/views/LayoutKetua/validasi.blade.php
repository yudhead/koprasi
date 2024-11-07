@extends('LayoutKetua.index')

@section('content')
<div class="main-content">
    <div class="container">
        <h2>Validasi Peminjaman</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Ketua</th>
                    <th>Wakil Ketua</th>
                    <th>Sekertaris</th>
                    <th>Bendahara</th>
                    <th>Pengawas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamans as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>Rp.{{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</td>
                        
                        <!-- Ketua -->
                        <td id="ketua-status-{{ $item->id }}">
                            @if($item->ketua_status === 'disetujui')
                                <span class="text-success">Data disetujui</span>
                            @elseif($item->ketua_status === 'tidak disetujui')
                                <span class="text-danger">Data tidak disetujui</span>
                            @elseif(auth()->user()->role_id === \App\Models\Role::KETUA)
                                <button onclick="approve({{ $item->id }}, 'ketua')">
                                    <i class="far fa-check-circle"></i> Setuju
                                </button>
                                <button onclick="disapprove({{ $item->id }}, 'ketua')">
                                    <i class="far fa-times-circle"></i> Tidak Setuju
                                </button>
                            @endif
                        </td>
                        
                        
                        <!-- Wakil Ketua -->
                        <td id="wakil_ketua-status-{{ $item->id }}">
                            @if($item->wakil_ketua_status === 'disetujui')
                                <span class="text-success">Data disetujui</span>
                            @elseif($item->wakil_ketua_status === 'tidak disetujui')
                                <span class="text-danger">Data tidak disetujui</span>
                            @elseif(auth()->user()->role_id === \App\Models\Role::WAKIL_KETUA)
                                <button onclick="approve({{ $item->id }}, 'wakil_ketua')">
                                    <i class="far fa-check-circle"></i> Setuju
                                </button>
                                <button onclick="disapprove({{ $item->id }}, 'wakil_ketua')">
                                    <i class="far fa-times-circle"></i> Tidak Setuju
                                </button>
                            @endif
                        </td>
                        
                        <!-- Sekertaris -->
                        <td id="sekertaris-status-{{ $item->id }}">
                            @if($item->sekertaris_status === 'disetujui')
                                <span class="text-success">Data disetujui</span>
                            @elseif($item->sekertaris_status === 'tidak disetujui')
                                <span class="text-danger">Data tidak disetujui</span>
                            @elseif(auth()->user()->role_id === \App\Models\Role::SEKERTARIS)
                                <button onclick="approve({{ $item->id }}, 'sekertaris')">
                                    <i class="far fa-check-circle"></i> Setuju
                                </button>
                                <button onclick="disapprove({{ $item->id }}, 'sekertaris')">
                                    <i class="far fa-times-circle"></i> Tidak Setuju
                                </button>
                            @endif
                        </td>
                        
                        <!-- Bendahara -->
                        <td id="bendahara-status-{{ $item->id }}">
                            @if($item->bendahara_status === 'disetujui')
                                <span class="text-success">Data disetujui</span>
                            @elseif($item->bendahara_status === 'tidak disetujui')
                                <span class="text-danger">Data tidak disetujui</span>
                            @elseif(auth()->user()->role_id === \App\Models\Role::BENDAHARA)
                                <button onclick="approve({{ $item->id }}, 'bendahara')">
                                    <i class="far fa-check-circle"></i> Setuju
                                </button>
                                <button onclick="disapprove({{ $item->id }}, 'bendahara')">
                                    <i class="far fa-times-circle"></i> Tidak Setuju
                                </button>
                            @endif
                        </td>
                        
                        <!-- Pengawas -->
                        <td id="pengawas-status-{{ $item->id }}">
                            @if($item->pengawas_status === 'disetujui')
                                <span class="text-success">Data disetujui</span>
                            @elseif($item->pengawas_status === 'tidak disetujui')
                                <span class="text-danger">Data tidak disetujui</span>
                            @elseif(auth()->user()->role_id === \App\Models\Role::PENGAWAS)
                                <button onclick="approve({{ $item->id }}, 'pengawas')">
                                    <i class="far fa-check-circle"></i> Setuju
                                </button>
                                <button onclick="disapprove({{ $item->id }}, 'pengawas')">
                                    <i class="far fa-times-circle"></i> Tidak Setuju
                                </button>
                            @endif
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function approve(id, role) {
        $.ajax({
            url: `/validasi/approve/${id}`,
            type: 'POST',
            data: {
                role: role,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response.message);
                // Ganti tombol dengan teks status persetujuan
                $(`#${role}-status-${id}`).html('<span class="text-success">Data disetujui</span>');
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
                alert("Terjadi kesalahan, silakan coba lagi.");
            }
        });
    }

    function disapprove(id, role) {
        $.ajax({
            url: `/validasi/disapprove/${id}`,
            type: 'POST',
            data: {
                role: role,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response.message);
                // Ganti tombol dengan teks status penolakan
                $(`#${role}-status-${id}`).html('<span class="text-danger">Data tidak disetujui</span>');
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
                alert("Terjadi kesalahan, silakan coba lagi.");
            }
        });
    }
</script>
@endsection
