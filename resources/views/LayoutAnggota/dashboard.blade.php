<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kopsadar Makmur Sejahtera (SMS)</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/layoutsekertaris.css') }}">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li class="active"><i class="fa fa-user"></i> Anggota</li>
            <li><i class="fa fa-credit-card"></i> Peminjaman</li>
            <li><i class="fa fa-file"></i> Laporan</li>
            <li><i class="fa fa-check"></i> Validasi</li>
            <li><i class="fa fa-money"></i> Pembayaran</li>
            <li><i class="fa fa-info"></i> Informasi</li>
            <li class="logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fa fa-sign-out"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</body>
</html>
