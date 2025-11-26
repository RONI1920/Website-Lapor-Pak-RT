<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <<<<<<< HEAD=======>>>>>>> 3c97985330ae5606e912d4678b7943c3788a7295
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

        <<<<<<< HEAD=======>>>>>>> 3c97985330ae5606e912d4678b7943c3788a7295
</head>

<body>
    <div class="kotak-register">
        <h1>Register Jadi Warga RT002/008 </h1>
        <h2>Selamat Bergabung Warga</h2>

        <<<<<<< HEAD <div class="kotak-register">
            <h1>Register Warga RT002/008</h1>
            <h2>Selamat Bergabung Warga</h2>

            =======
            >>>>>>> 3c97985330ae5606e912d4678b7943c3788a7295
            <form action="/register" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Name Warga" required><br>
                <input type="email" name="email" placeholder="Email " required><br>
                <input type="text" name="phone" placeholder="No Phone " required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <input type="password" name="re_password" placeholder="Re-Password" required><br>
                <<<<<<< HEAD <button type="submit">Register Warga</button>
            </form><br>
            <a href="/login">Sudah Punya Akun Warga ?</a>

    </div>
    =======
    <button type="submit">Register Warga </button>
    </form>
    <br>
    <a href="/login">Sudah Punya Akun Warga ?</a>
    >>>>>>> 3c97985330ae5606e912d4678b7943c3788a7295

    </div>
</body>

</html>
