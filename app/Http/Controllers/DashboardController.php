<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Tambahkan import Model User

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan hanya admin yang bisa akses dashboard admin
        if (Auth::user()->usertype !== 'admin') {
            return redirect('/home');
        }

        // Ambil data untuk dashboard admin
        // (Sesuaikan logika pengambilan datanya jika perlu, contoh:)
        $laporans = Laporan::with('user')->latest()->get();

        return view('admin.admin_rt', compact('laporans'));
    }

    public function inbox()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Kita simpan ke variabel dulu biar VS Code paham

        $notifications = $user->notifications;

        return view('home.inbox', compact('notifications'));
    }

    public function markAsRead($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Ambil notifikasi berdasarkan ID
        $notification = $user->notifications()->findOrFail($id);

        // Tandai sudah dibaca
        $notification->markAsRead();

        // Redirect ke detail laporan (sesuai nama route kamu: 'detail_laporan')
        return redirect()->route('detail_laporan', $notification->data['laporan_id']);
    }
}
