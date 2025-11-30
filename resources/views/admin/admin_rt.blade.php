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
                        <p class="card-text fs-4 fw-bold">{{ $laporans->where('status', 'respon')->count() }}</p>
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
                        <p class="card-text fs-4 fw-bold">{{ $laporans->where('status', 'proses')->count() }}</p>
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
                        <p class="card-text fs-4 fw-bold">{{ $laporans->where('status', 'selesai')->count() }}</p>
                    </div>
                    <div class="card-icon opacity-50">✅</div>
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
                                            class="btn btn-sm btn-outline-secondary">Lihat</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($laporan->status == 'pending')
                                        <span class="badge bg-danger">Pending</span>
                                    @elseif($laporan->status == 'respon')
                                        <span class="badge bg-info text-dark">Ditanggapi</span>
                                    @elseif($laporan->status == 'proses')
                                        <span class="badge bg-warning text-dark">Proses</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('detail_laporan', $laporan->id) }}"
                                        class="btn btn-sm btn-info text-white mb-1">Detail</a>

                                    <div class="dropdown d-inline">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            Update Status
                                        </button>
                                        <ul class="dropdown-menu">

                                            <li>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#modalRespon{{ $laporan->id }}">
                                                    💬 1. Tanggapi (Jadwal)
                                                </button>
                                            </li>

                                            <li>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#modalProses{{ $laporan->id }}">
                                                    ⏳ 2. Proses Pengerjaan
                                                </button>
                                            </li>

                                            <li>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#modalSelesai{{ $laporan->id }}">
                                                    ✅ 3. Tandai Selesai
                                                </button>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="modal fade" id="modalRespon{{ $laporan->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title">Tahap 1: Berikan Respon</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('update_laporan', $laporan->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="status" value="respon">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Jadwal / Rencana
                                                                Penanganan:</label>
                                                            <textarea name="tanggapan" class="form-control" rows="4"
                                                                placeholder="Contoh: &#10;- Hari: Senin&#10;- Jam: 09.00&#10;- Pihak: Dinas Kebersihan&#10;&#10;Mohon ditunggu."
                                                                required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-info text-white">Kirim
                                                            Respon</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modalProses{{ $laporan->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning text-dark">
                                                    <h5 class="modal-title">Tahap 2: Mulai Pengerjaan</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('update_laporan', $laporan->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="status" value="proses">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Foto Bukti Pengerjaan
                                                                (Awal)
                                                                :</label>
                                                            <input type="file" name="foto_selesai"
                                                                class="form-control" required>
                                                            <small class="text-muted">Foto petugas sedang bekerja di
                                                                lokasi.</small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Update Pesan:</label>
                                                            <textarea name="tanggapan" class="form-control" rows="2"
                                                                placeholder="Contoh: Petugas sudah sampai dan sedang memperbaiki." required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-warning">Update
                                                            Proses</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modalSelesai{{ $laporan->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title">Tahap 3: Selesaikan Laporan</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('update_laporan', $laporan->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="status" value="selesai">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Foto Bukti Hasil
                                                                Akhir:</label>
                                                            <input type="file" name="foto_selesai"
                                                                class="form-control" required>
                                                            <small class="text-muted">Foto bukti bahwa masalah sudah
                                                                beres.</small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Pesan Penutup:</label>
                                                            <textarea name="tanggapan" class="form-control" rows="2"
                                                                placeholder="Contoh: Sudah selesai diperbaiki. Terima kasih laporannya." required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">Simpan &
                                                            Selesai</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
