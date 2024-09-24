<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="{{ asset('assets/DataPengguna.css') }}">
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
            <li><a href="{{ route('bendahara.DataPengguna') }}"><i class="fa fa-credit-card"></i>Data Pengguna</a></li>
            <li><a href="#"><i class="fa fa-credit-card"></i>Rekap Data</a></li>
            <li><a href="#"><i class="fa fa-file"></i>Peminjaman</a></li>
            <li><a href="#"><i class="fa fa-check"></i>Laporan</a></li>
            <li><a href="#"><i class="fa fa-check"></i>Validasi</a></li>
            <li><a href="#"><i class="fa fa-money"></i>Pembayaran</a></li>
            <li><a href="#"><i class="fa fa-info"></i>Informasi</a></li>
            <li class="logout">
                <form action="{{ route ('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fa fa-sign-out"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <input type="text" placeholder="Search...">
            
        </div>
        
        <button class="btn-add" onclick="location.href='#'">Tambah Data Pengguna</button>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Jumlah Angsuran</th>
                    <th>Simpanan Wajib</th>
                    <th>Simpanan Sukarela</th>
                    <th>Pinjaman</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows for user data can be dynamically loaded here -->
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>123456789</td>
                    <td>01/01/1990</td>
                    <td>Jl. Example</td>
                    <td>08123456789</td>
                    <td>Rp 10,000,000</td>
                    <td>Rp 1,000,000</td>
                    <td>Rp 500,000</td>
                    <td>Rp 200,000</td>
                    <td>Rp 9,000,000</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</body>
</html>
