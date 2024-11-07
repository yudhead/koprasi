<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kopsadar Makmur Sejahtera (SMS)</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/layoutKetua.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="sidebar">
        <ul>
            @if(auth()->user()->role === 'ketua')
                <li class="active"><i class="fa fa-user"></i> Ketua</li>
            @else
                <li><a href="{{ route('ketua.dashboard') }}"><i class="fa fa-user"></i> Ketua</a></li>
            @endif
            <li><a href="{{ route('ketua.peminjaman.index') }}"><i class="fa fa-file"></i>Peminjaman</a></li>
            <li><a href="{{ route('ketua.laporan.index') }}"><i class="fa fa-check"></i>Laporan</a></li>
            <li><a href="{{ route('ketua.validasi') }}"><i class="fa fa-check"></i>Validasi</a></li>
            <li><a href="{{ route('ketua.pembayaran.index') }}"><i class="fa fa-money"></i>Pembayaran</a></li>
            <li><a href="#"><i class="fa fa-info"></i>Informasi</a></li>
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