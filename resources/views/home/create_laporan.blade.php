<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f8f9fa;">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4>Form Laporan Pengaduan</h4>
                    </div>
                    <div class="card-body">
                        <form action="/laporan/store" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label>Judul Laporan</label>
                                <input type="text" name="judul" class="form-control"
                                    placeholder="Contoh: Sampah Menumpuk" required>
                            </div>

                            <div class="mb-3">
                                <label>Deskripsi Masalah</label>
                                <textarea name="deskripsi" class="form-control" rows="5" placeholder="Jelaskan detail masalah..." required></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Foto Bukti (Opsional)</label>
                                <input type="file" name="foto" class="form-control">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="/home" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
