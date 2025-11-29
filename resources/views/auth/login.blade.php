<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login Warga</title>
    <link rel="stylesheet" href="{{ asset('css/auth.style.css') }}">


</head>

<body>
    <div class="kotak-login">
        <h1>Halaman Login Warga </h1>
        @if (@session('error'))
            <p style="color-red;">{{ session('error') }}</p>
        @endif
        @if (@session('sukses'))
            <p style="color-green;">{{ session('sukses') }}</p>
        @endif

        <form action="/login" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email " required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login Warga</button>
        </form><br>
        <a href="/register">Daftar Akun Warga ?</a>

        <p class="mt-4 text-muted small">
            &copy; 2025 Rukun Tetangga 002. All Rights Reserved.
        </p>
    </div>
</body>

</html>
