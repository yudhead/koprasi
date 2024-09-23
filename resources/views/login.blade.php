<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kopsadar Makmur Sejahtera (SMS) - Login</title>
    <link rel="stylesheet" href="{{ asset('assets/csslogin.css') }}">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('foto/sms.png') }}" alt="Kopsadar Makmur Sejahtera (SMS)">
        </div>
        <div class="form-container">
            <h2>LOGIN</h2>
             @csrf
             <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Masukkan email Anda">
                <input type="password" name="password" placeholder="Masukkan password Anda">
                <button type="submit">Login</button>
            </form>


        </div>
    </div>
</body>
</html>
