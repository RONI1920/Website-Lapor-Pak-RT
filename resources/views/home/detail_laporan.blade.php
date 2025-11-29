<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f8f9fa;">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (Auth::user()->usertype == 'admin')
                    <a href="/admin_rt" class="btn btn-secondary mb-3">&laquo; Kembali ke Dashboard Admin</a>
                @else
                    <a href="/home" class="btn btn-secondary mb-3">&laquo; Kembali ke Dashboard</a>
                @endif

                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Detail Laporan #{{ $laporan->id }}</h4>

                        @if ($laporan->status == 'pending')
                            <span class="badge bg-danger">Pending</span>
                        @elseif($laporan->status == 'proses')
                            <span class="badge bg-warning text-dark">Sedang Diproses</span>
                        @else
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </div>
                    <div class="card-body">

                        <div class="alert alert-info">
                            <strong>Pelapor:</strong> {{ $laporan->user->name }} <br>
                            <strong>Tanggal:</strong> {{ $laporan->created_at->format('d M Y, H:i') }} WIB
                        </div>

                        <h3 class="mt-3">{{ $laporan->judul }}</h3>
                        <p class="fs-5 text-muted">{{ $laporan->deskripsi }}</p>

                        <hr>

                        <h5 class="mb-3">Foto Bukti:</h5>
                        @if ($laporan->foto)
                            <img src="{{ asset('storage/' . $laporan->foto) }}"
                                class="img-fluid rounded border shadow-sm"
                                style="max-height: 500px; width: 100%; object-fit: contain;">
                        @else
                            <div class="text-center py-5 bg-light border rounded text-muted">
                                Tidak ada foto bukti yang dilampirkan.
                            </div>
                        @endif

                    </div>

                    @if (Auth::user()->usertype == 'admin')
                        <div class="card-footer text-end">
                            <form action="{{ route('update_laporan', $laporan->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="proses">
                                <button class="btn btn-warning text-white">Proses</button>
                            </form>

                            <form action="{{ route('update_laporan', $laporan->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="selesai">
                                <button class="btn btn-success">Selesai</button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</body>

</html>
