<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Admin Lapor Pak RT 002 RW 008</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.style.css') }}">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <nav class="col-md-3 col-lg-2 d-md-block sidebar p-3 collapse">
                <h4 class="text-white">Lapor Pak RT</h4>
                <hr class="text-white">

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Inbox Laporan Warga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Data Warga</a>
                    </li>

                    <li class="nav-item mt-5">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>

            <footer class="mt-5 pt-3 border-top text-center text-muted small">
                <p>&copy; 2025 Rukun Tetangga 002. All Rights Reserved.</p>
            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
