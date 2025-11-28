<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Admin Lapor Pak RT 002 RW 008</title>
    <link rel="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sedikit CSS manual agar sidebar tingginya full layar */
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }
    </style>

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <nav class="col-md-2 sidebar p-3">
                <h4>Lapor Pak RT</h4>
                <hr>
                <ul class="nav flex columns">
                    <li class="nav-item">
                        <a href="#"> Dashboard</a>
                    </li>
                    <li class="van-item">
                        <a href="#">inbox laporan Warga</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">Data Warga</a>
                    </li>
                    <li class="nav-item mt-5">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>

            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
