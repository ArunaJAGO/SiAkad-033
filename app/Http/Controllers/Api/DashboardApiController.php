<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\Pengumuman;

class DashboardApiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data user yang sedang login dari token
        $user = $request->user();

        // Hitung total matakuliah yang diambil di KRS
        $totalMatkulKrs = Krs::where('mahasiswa_id', $user->id)->count();

        // Ambil 3 pengumuman terbaru
        $pengumumanTerbaru = Pengumuman::orderBy('created_at', 'desc')->take(3)->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'profil_mahasiswa' => [
                    'nama' => $user->name,
                    'email_kampus' => $user->username,
                    'status_akademik' => 'Aktif'
                ],
                'statistik' => [
                    'total_matkul_diambil' => $totalMatkulKrs,
                    // Kamu bisa menambahkan logika hitung IPK / Total SKS di sini nanti
                ],
                'pengumuman_terbaru' => $pengumumanTerbaru
            ]
        ], 200);
    }
}