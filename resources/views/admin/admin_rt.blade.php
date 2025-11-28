@extends('layout.layout_base')

@section('content')
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, Pak RT!</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-header">Laporan Masuk</div>
                <div class="card-body">
                    <h1 class="card-title">0</h1>
                    <p class="card-text">Belum diproses</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-header">Laporan Selesai</div>
                <div class="card-body">
                    <h1 class="card-title">0</h1>
                    <p class="card-text">Sudah ditangani</p>
                </div>
            </div>
        </div>
    </div>
@endsection
