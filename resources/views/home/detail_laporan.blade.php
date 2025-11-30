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
                        @elseif($laporan->status == 'respon')
                            <span class="badge bg-info text-dark">Ditanggapi</span>
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

                        <h5 class="mb-3">Foto Bukti (Warga):</h5>
                        @if ($laporan->foto)
                            <img src="{{ asset('storage/' . $laporan->foto) }}"
                                class="img-fluid rounded border shadow-sm"
                                style="max-height: 500px; width: 100%; object-fit: contain;">
                        @else
                            <div class="text-center py-5 bg-light border rounded text-muted">
                                Tidak ada foto bukti yang dilampirkan.
                            </div>
                        @endif

                        @if ($laporan->tanggapan)
                            <hr class="my-4">

                            @if ($laporan->status == 'respon')
                                <div class="alert alert-info shadow-sm">
                                    <h4 class="alert-heading">💬 Respon & Jadwal</h4>
                                    <p class="mb-0" style="white-space: pre-line;">{{ $laporan->tanggapan }}</p>
                                    <hr>
                                    <small>Terima Kasih Atas Laporan Warga !</small>
                                </div>
                            @elseif($laporan->status == 'proses')
                                <div class="alert alert-warning text-dark">
                                    <h4 class="alert-heading">⏳ Sedang Dikerjakan</h4>
                                    <p>{{ $laporan->tanggapan }}</p>

                                    @if ($laporan->foto_selesai)
                                        <hr>
                                        <strong>Foto Progres:</strong><br>
                                        <img src="{{ asset('storage/' . $laporan->foto_selesai) }}"
                                            class="img-fluid rounded shadow-sm border mt-2" style="max-height: 400px;">
                                    @endif
                                </div>
                            @elseif($laporan->status == 'selesai')
                                <div class="alert alert-success mt-4">
                                    <h4 class="alert-heading">🎉 Laporan Selesai!</h4>
                                    <p class="mb-2">
                                        <strong>Pesan Pak RT:</strong><br>
                                        "{{ $laporan->tanggapan }}"
                                    </p>

                                    @if ($laporan->foto_selesai)
                                        <hr>
                                        <p class="mb-2">Bukti Foto Hasil Akhir:</p>
                                        <img src="{{ asset('storage/' . $laporan->foto_selesai) }}"
                                            class="img-fluid rounded shadow-sm border" style="max-height: 400px;">
                                    @endif
                                </div>
                            @endif
                        @endif

                    </div>

                    @if (Auth::user()->usertype == 'admin' && $laporan->status != 'selesai')
                        <div class="card-footer bg-light">
                            <h5 class="mb-3">Update Status & Tanggapan:</h5>

                            <form action="{{ route('update_laporan', $laporan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Pesan / Tanggapan:</label>
                                    <textarea name="tanggapan" class="form-control" rows="3"
                                        placeholder="Tulis respon, jadwal, atau update pengerjaan..." required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small text-muted">Upload Bukti (Opsional):</label>
                                    <input type="file" name="foto_selesai" class="form-control form-control-sm">
                                </div>

                                <div class="d-flex justify-content-end gap-2">

                                    <button type="submit" name="status" value="respon"
                                        class="btn btn-info text-white fw-bold">
                                        💬 Kirim Respon
                                    </button>

                                    <button type="submit" name="status" value="proses"
                                        class="btn btn-warning text-dark fw-bold">
                                        ⏳ Proses Kerja
                                    </button>

                                    <button type="submit" name="status" value="selesai"
                                        class="btn btn-success fw-bold">
                                        ✅ Selesai
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</body>

</html>
