@extends('layout.layout_base')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Dashboard Admin</h2>
    </div>
    <p>Selamat Datang, Pak RT! Berikut ringkasan laporan warga.</p>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-bg-danger mb-3 shadow-sm">
                <div class="card-header">Perlu Dicek</div>
                <div class="card-body">
                    <h1 class="card-title fw-bold">{{ $laporans->where('status', 'pending')->count() }}</h1>
                    <p class="card-text">Laporan Baru Masuk</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-warning text-dark mb-3 shadow-sm">
                <div class="card-header">Sedang Dikerjakan</div>
                <div class="card-body">
                    <h1 class="card-title fw-bold">{{ $laporans->where('status', 'proses')->count() }}</h1>
                    <p class="card-text">Dalam Penanganan</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success mb-3 shadow-sm">
                <div class="card-header">Selesai</div>
                <div class="card-body">
                    <h1 class="card-title fw-bold">{{ $laporans->where('status', 'selesai')->count() }}</h1>
                    <p class="card-text">Masalah Teratasi</p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mt-5">Daftar Laporan Masuk</h4>
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Pelapor</th>
                            <th>Tanggal</th>
                            <th>Judul & Deskripsi</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $laporan->user->name }}</strong><br>
                                    <small class="text-muted">{{ $laporan->user->email }}</small>
                                </td>
                                <td>{{ $laporan->created_at->format('d M Y') }}</td>
                                <td style="width: 30%;">
                                    <strong>{{ $laporan->judul }}</strong>
                                    <p class="text-muted small mb-0">{{ Str::limit($laporan->deskripsi, 50) }}</p>
                                </td>
                                <td>
                                    @if ($laporan->foto)
                                        <a href="{{ asset('storage/' . $laporan->foto) }}" target="_blank"
                                            class="btn btn-sm btn-outline-secondary">
                                            Lihat
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($laporan->status == 'pending')
                                        <span class="badge bg-danger">Pending</span>
                                    @elseif($laporan->status == 'proses')
                                        <span class="badge bg-warning text-dark">Proses</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('detail_laporan', $laporan->id) }}"
                                        class="btn btn-sm btn-info text-white mb-1">
                                        Detail
                                    </a>

                                    <div class="dropdown d-inline">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            Ubah Status
                                        </button>
                                        <ul class="dropdown-menu">

                                            <li>
                                                <form action="{{ route('update_laporan', $laporan->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="proses">
                                                    <button type="submit" class="dropdown-item">⏳ Proses Laporan</button>
                                                </form>
                                            </li>

                                            <li>
                                                <form action="{{ route('update_laporan', $laporan->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="selesai">
                                                    <button type="submit" class="dropdown-item">✅ Tandai Selesai</button>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <em>Belum ada laporan masuk dari warga.</em>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
