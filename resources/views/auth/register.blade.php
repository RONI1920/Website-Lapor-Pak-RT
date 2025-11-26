<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>

<body>

    <h1>Halaman Register</h1>

    <form action="/register" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name Warga" required><br>
        <input type="email" name="email" placeholder="Email " required><br>
        <input type="text" name="phone" placeholder="No Phone " required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="re_password" placeholder="Re-Password" required><br>
        <button type="submit">Register Warga</button>
    </form>
    <a href="/login">Sudah Punya Akun Warga ?</a>

</body>

</html>
