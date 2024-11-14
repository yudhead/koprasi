@if($status === 'disetujui')
    <span class="text-success">Data disetujui</span>
@elseif($status === 'tidak disetujui')
    <span class="text-danger">Data tidak disetujui</span>
@elseif(auth()->user()->role === $role)
    <button onclick="approve({{ $item->id }}, '{{ $role }}')">
        <i class="far fa-check-circle"></i> Setuju
    </button>
    <button onclick="disapprove({{ $item->id }}, '{{ $role }}')">
        <i class="far fa-times-circle"></i> Tidak Setuju
    </button>
@endif
