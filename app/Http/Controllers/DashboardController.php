<?php

namespace App\Http\Controllers;

use App\Models\laporan;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $laporans = laporan::with('user')->latest()->get();

        return view('admin.admin_rt', compact('laporans'));
    }
}
