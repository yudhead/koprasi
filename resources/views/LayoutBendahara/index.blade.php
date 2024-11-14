<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kopsadar Makmur Sejahtera (SMS)</title>
    <link rel="stylesheet" href="{{ asset('assets/layoutBendahara.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <ul>
            @if(auth()->user()->role === 'bendahara')
                <li class="active"><i class="fa fa-user"></i> Bendahara</li>
            @else
                <li><a href="{{ route('bendahara.dashboard') }}"><i class="fa fa-user"></i> Bendahara</a></li>
            @endif
            <li><a href="{{ route('data-pengguna.index') }}"><i class="fa fa-credit-card"></i>Data Pengguna</a></li>
            <li><a href="{{ route('rekap-data.index') }}"><i class="fa fa-credit-card"></i>Rekap Data</a></li>
            <li><a href="{{ route('bendahara.peminjaman.index') }}"><i class="fa fa-file"></i>Peminjaman</a></li>
            <li><a href="{{ route('bendahara.laporan.index') }}"><i class="fa fa-check"></i>Laporan</a></li>
            <li><a href="{{ route('bendahara.validasi') }}"><i class="fa fa-check"></i>Validasi</a></li>
            <li><a href="{{ route('bendahara.pembayaran.index') }}"><i class="fa fa-money"></i>Pembayaran</a></li>
            <li><a href="{{ route('informasi.index') }}"><i class="fa fa-info"></i>Informasi</a></li>
            <li class="logout">
                <form action="{{ route('logout') }}" method="POST">
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

    <script>
        // Mengaktifkan pjax untuk semua link kecuali logout
        $(document).pjax('a:not(.logout-btn)', '#pjax-container');

        // Optional: Tambahkan loader saat perpindahan halaman
        $(document).on('pjax:start', function() {
            $('.content-wrapper').fadeOut('fast'); // Efek fade out sebelum load
        });
        $(document).on('pjax:end', function() {
            $('.content-wrapper').fadeIn('fast'); // Efek fade in setelah load
        });
    </script>
</body>
