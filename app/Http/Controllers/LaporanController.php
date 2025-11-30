<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\laporan as ModelsLaporan;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use App\Notifications\LaporanStatusUpdate;

class LaporanController extends Controller
{
    // 1. Menampilkan Halaman Form
    public function create()
    {
        return view('home.create_laporan');
    }

    // 2. Logika Menyimpan Data ke Database
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'foto' => 'image|file|max:2048'
        ]);

        // 2. Siapkan Data
        $laporan = new Laporan;
        $laporan->user_id = Auth::id();
        $laporan->judul = $request->judul;
        $laporan->deskripsi = $request->deskripsi;

        // --- BAGIAN UPLOAD DENGAN RENAME (TIME) ---
        if ($request->file('foto')) {
            $file = $request->file('foto');

            $nama_file = time() . "_" . $file->getClientOriginalName();

            // Simpan file dengan nama baru (storeAs)
            // Parameter: (Nama Folder, Nama File Baru, Disk Public)
            $file->storeAs('bukti_laporan', $nama_file, 'public');

            // Simpan path ke database
            $laporan->foto = 'bukti_laporan/' . $nama_file;
        }
        // ------------------------------------------

        $laporan->save();

        return redirect('/home')->with('success', 'Laporan berhasil dikirim!');
    }

    // Menampilkan detail laporan

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('home.detail_laporan', compact('laporan'));
    }
    public function UpdateStatus(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;

        if ($request->has('tanggapan')) {
            $laporan->tanggapan = $request->tanggapan;
        }

        if ($request->file('foto_selesai')) {
            $file = $request->file('foto_selesai');
            $nama_file = time() . "_selesai_" . $file->getClientOriginalName();
            $file->storeAs('bukti_selesai', $nama_file, 'public');
            $laporan->foto_selesai = 'bukti_selesai/' . $nama_file;
        }

        $laporan->save();

        // --- KIRIM NOTIFIKASI KE DASHBOARD WARGA ---
        // $laporan->user artinya notifikasi dikirim ke pemilik laporan
        $laporan->user->notify(new LaporanStatusUpdate($laporan));
        // -------------------------------------------

        return redirect()->route('admin_rt')->with('success', 'Status diperbarui & Notifikasi dikirim!');
    }
}
