@extends('layout.layout_base')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Kotak Masuk</h2>

        @if (Auth::user()->unreadNotifications->count() > 0)
            <a href="{{ route('notifikasi.read') }}" class="btn btn-sm btn-outline-primary">
                Tandai Semua Dibaca
            </a>
        @endif
    </div>

    <div class="card shadow-sm">
        <div class="list-group list-group-flush">
            @forelse($notifications as $notif)
                <div class="list-group-item list-group-item-action d-flex gap-3 py-3 {{ $notif->read_at ? '' : 'bg-light' }}"
                    aria-current="true">

                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h6 class="mb-0">
                                @if (!$notif->read_at)
                                    <span class="text-primary">●</span>
                                @endif
                                Update Laporan: {{ $notif->data['judul'] }}
                            </h6>
                            <p class="mb-0 opacity-75">{{ $notif->data['pesan'] }}</p>
                        </div>
                        <small class="opacity-50 text-nowrap">{{ $notif->created_at->diffForHumans() }}</small>
                    </div>

                    <a href="{{ route('notifikasi.baca', $notif->id) }}" class="btn btn-sm btn-primary align-self-center">
                        Lihat</a>
                </div>
            @empty
                <div class="text-center py-5">
                    <p class="text-muted">Tidak ada pesan masuk.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
