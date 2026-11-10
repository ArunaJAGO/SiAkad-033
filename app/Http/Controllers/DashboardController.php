<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function dosenDashboard()
    {
        return view('dosen.dashboard');
    }

    public function mahasiswaDashboard()
    {
        // Bisa memanggil data nilai mahasiswa di sini nantinya
        return view('dashboard');
    }
}