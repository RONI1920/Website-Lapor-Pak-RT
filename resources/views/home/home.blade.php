<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warga - Lapor Pak RT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.style.css') }}">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <nav class="col-md-3 col-lg-2 d-md-block sidebar p-3 collapse">
                <h4 class="mb-4 fw-bold text-primary">Panel Warga</h4>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/home">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/laporan/create">+ Buat Laporan Baru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/laporan/riwayat">Riwayat Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profil Saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-between align-items-center"
                            href="{{ route('inbox') }}">
                            <span>
                                Kotak Masuk
                            </span>

                            @if (Auth::user()->unreadNotifications->count() > 0)
                                <span class="badge bg-danger rounded-pill">
                                    {{ Auth::user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item mt-5">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100 fw-bold">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                </div>

                <div class="mb-4">
                    @if (Auth::user()->unreadNotifications->count() > 0)

                        <div class="alert alert-info shadow-sm">
                            <h5 class="alert-heading">🔔 Notifikasi Baru</h5>
                            <ul class="list-group list-group-flush bg-transparent">

                                @foreach (Auth::user()->unreadNotifications as $notification)
                                    <li
                                        class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $notification->data['pesan'] }}</strong><br>
                                            <small class="text-muted">Judul Laporan:
                                                {{ $notification->data['judul'] }}</small>
                                        </div>
                                        <a href="{{ route('notifikasi.baca', $notification->id) }}"
                                            class="btn btn-sm btn-primary">Lihat</a>
                                    </li>
                                @endforeach

                            </ul>

                            <div class="mt-2 text-end">
                                <a href="{{ route('notifikasi.read') }}"
                                    class="text-decoration-none small fw-bold">Tandai Semua Sudah Dibaca</a>
                            </div>
                        </div>

                    @endif
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Total Laporan</h6>
                                    <p class="card-text fs-4 fw-bold">{{ $laporans->count() }}</p>
                                </div>
                                <div class="card-icon opacity-50">📝</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-white bg-info mb-3 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Ditanggapi</h6>
                                    <p class="card-text fs-4 fw-bold">
                                        {{ $laporans->where('status', 'respon')->count() }}</p>
                                </div>
                                <div class="card-icon opacity-50">💬</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Sedang Diproses</h6>
                                    <p class="card-text fs-4 fw-bold">
                                        {{ $laporans->where('status', 'proses')->count() }}</p>
                                </div>
                                <div class="card-icon opacity-50">⏳</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3 shadow-sm h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Selesai</h6>
                                    <p class="card-text fs-4 fw-bold">
                                        {{ $laporans->where('status', 'selesai')->count() }}</p>
                                </div>
                                <div class="card-icon opacity-50">✅</div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4>Riwayat Laporan Terakhir</h4>
                <div class="table-responsive mt-3">
                    <table class="table table-hover table-bordered shadow-sm align-middle">
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
                            @if ($laporans->count() > 0)
                                @foreach ($laporans as $laporan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $laporan->created_at->format('d M Y') }}</td>
                                        <td>{{ $laporan->judul }}</td>
                                        <td>
                                            @if ($laporan->status == 'pending')
                                                <span class="badge bg-secondary">Menunggu</span>
                                            @elseif($laporan->status == 'respon')
                                                <span class="badge bg-info text-dark">Ditanggapi</span>
                                            @elseif($laporan->status == 'proses')
                                                <span class="badge bg-warning text-dark">Diproses</span>
                                            @else
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('detail_laporan', $laporan->id) }}"
                                                class="btn btn-sm btn-info text-white">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <em>Belum ada laporan yang dibuat.</em>
                                    </td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm bg-light">
                            <div class="card-body text-center py-5">
                                <h3>Ada keluhan atau masalah di lingkungan RT?</h3>
                                <p class="text-muted">Sampaikan laporan Anda langsung kepada pengurus RT melalui sistem
                                    ini.</p>
                                <a href="/laporan/create" class="btn btn-primary btn-lg mt-2 px-4 shadow">Buat Laporan
                                    Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
