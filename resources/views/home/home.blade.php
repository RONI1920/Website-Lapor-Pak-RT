<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Warga - Lapor Pak RT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.style.css') }}">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <nav class="col-md-3 col-lg-2 d-md-block sidebar p-3 collapse">
                <h4 class="mb-4">Panel Warga</h4>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/home">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            + Buat Laporan Baru
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Riwayat Laporan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Profil Saya
                        </a>
                    </li>

                    <li class="nav-item mt-5">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light w-100 text-primary fw-bold">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Total Laporan</h5>
                                    <p class="card-text fs-4 fw-bold">0</p>
                                </div>
                                <div class="card-icon">📝</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Sedang Diproses</h5>
                                    <p class="card-text fs-4 fw-bold">0</p>
                                </div>
                                <div class="card-icon">⏳</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Selesai</h5>
                                    <p class="card-text fs-4 fw-bold">0</p>
                                </div>
                                <div class="card-icon">✅</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <h3>Ada keluhan atau masalah di lingkungan RT?</h3>
                                <p class="text-muted">Sampaikan laporan Anda langsung kepada pengurus RT melalui sistem
                                    ini.</p>
                                <a href="#" class="btn btn-primary btn-lg mt-2">Buat Laporan Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>

                <h4>Riwayat Laporan Terakhir</h4>
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Judul Laporan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada laporan yang dibuat.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
