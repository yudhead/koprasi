@extends('LayoutBendahara.index')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="main-content">
    <h2>Tambah Rekap Data</h2>

    <!-- Form Tambah Rekap Data -->
    <form action="{{ route('bendahara.storeRekap') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="simpanan_wajib">Simpanan Wajib</label>
            <input type="number" id="simpanan_wajib" name="simpanan_wajib" class="form-control" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="simpanan_sukarela">Simpanan Sukarela</label>
            <input type="number" id="simpanan_sukarela" name="simpanan_sukarela" class="form-control" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="pinjaman">Pinjaman</label>
            <input type="number" id="pinjaman" name="pinjaman" class="form-control" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" id="total" name="total" class="form-control" step="0.01" readonly>
        </div>

        <button type="submit" class="btn-add">Simpan Rekap</button>
        <button type="button" class="btn-back" onclick="location.href='{{ route('bendahara.RekapData') }}'">Kembali</button>
    </form>

</div>

<script>
    // Update the total automatically when the values of simpanan wajib, sukarela, or pinjaman change
    document.getElementById('simpanan_wajib').addEventListener('input', calculateTotal);
    document.getElementById('simpanan_sukarela').addEventListener('input', calculateTotal);
    document.getElementById('pinjaman').addEventListener('input', calculateTotal);

    function calculateTotal() {
        const wajib = parseFloat(document.getElementById('simpanan_wajib').value) || 0;
        const sukarela = parseFloat(document.getElementById('simpanan_sukarela').value) || 0;
        const pinjaman = parseFloat(document.getElementById('pinjaman').value) || 0;
        const total = wajib + sukarela + pinjaman;
        document.getElementById('total').value = total.toFixed(2);
    }
</script>

@endsection
