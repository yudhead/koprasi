<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kopsadar Makmur Sejahtera (SMS)</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/layoutsekertaris.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="sidebar">
        <ul>
            @if(auth()->user()->role === 'anggota')
            <li class="active"><i class="fa fa-user"></i> Anggota</li>
        @else
            <li><a href=#"><i class="fa fa-user"></i> Anggota</a></li>
        @endif

            <li><a href="{{ route('PeminjamanAnggota.index') }}"><i class="fa fa-credit-card"></i> Peminjaman</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-money"></i> Laporan <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" style="background-color: #868080;">
                    <li><a href="{{ route('LaporanAngsuran.index') }}"><i class="fa fa-money"></i> Laporan Angsuran</a></li>
                    <li><a href="{{ route('LaporanAngsuranWajib.index') }}"><i class="fa fa-money"></i> Laporan Simpanan Wajib</a></li>
                    <li><a href="{{ route('LaporanAngsuranSukarela.index') }}"><i class="fa fa-money"></i> Laporan Simpanan Sukarela</a></li>
                </ul>
            </li>
            <li><a href=#><i class="fa fa-check"></i> Validasi</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-money"></i> Pembayaran <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" style="background-color: #868080;">
                    <li><a href="{{ route('PembayaranAngsuran.index') }}"><i class="fa fa-money"></i> Pembayaran Angsuran</a></li>
                    <li><a href="{{ route('PembayaranWajib.index') }}"><i class="fa fa-money"></i> Pembayaran Simpanan Wajib</a></li>
                    <li><a href="{{ route('PembayaranSukarela.index') }}"><i class="fa fa-money"></i> Pembayaran Simpanan Sukarela</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-info"></i> Informasi</a></li>
            <li class="logout">
                <form action="{{ route ('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fa fa-sign-out"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
    <div class="content-wrapper">
        <div id="pjax-container">
            @yield('content')
        </div>
    </div>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        // Mengaktifkan pjax untuk semua link kecuali logout
        $(document).pjax('a:not(.logout a)', '#pjax-container');

        // Optional: Tambahkan loader saat perpindahan halaman
        $(document).on('pjax:start', function() {
            $('.content-wrapper').fadeOut('fast'); // Efek fade out sebelum load
        });
        $(document).on('pjax:end', function() {
            $('.content-wrapper').fadeIn('fast'); // Efek fade in setelah load
        });


    </script>
</body>
