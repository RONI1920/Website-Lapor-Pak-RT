<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login Warga</title>
</head>

<body>

    <h1>Halaman Login</h1>

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
    </form>
    <a href="/register">Daftar Akun Warga ?</a>

</body>

</html>
