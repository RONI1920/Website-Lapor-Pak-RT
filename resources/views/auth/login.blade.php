<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login Warga</title>

    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .kotak-login {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .h2 {
            align-items: center;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .error-msg {
            color: red;
            font-size: 12px;
            text-align: left;
            margin-top: -5px;
            margin-bottom: 10px;
            display: block;
        }
    </style>

</head>

<body>
    <div class="kontak-login">
        <h1>Lapor Pak RT 📢 </h1>
        <p>Silahkan Login </p>

        @if (session()->has('error'))
            <p style="color:red; background-color:#ffe6e6 ; padding:10px>"{{ session('error') }}</p>
        @endif

        @if (session()->has('sukses'))
            <p style="color:green;
                background-color:#ffe6e6; padding:10px">{{ session('sukses') }}</p>
        @endif


        <form action="/login" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email " required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login Warga</button>
        </form>
        <br>
        <a href="/register">Daftar Akun Warga ?</a>

    </div>
</body>

</html>
