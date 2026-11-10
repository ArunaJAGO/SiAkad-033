<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import Semua Controller API
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\DashboardApiController;
use App\Http\Controllers\Api\MataKuliahApiController;
use App\Http\Controllers\Api\KrsApiController;
use App\Http\Controllers\Api\NilaiApiController;
use App\Http\Controllers\Api\PresensiApiController;
use App\Http\Controllers\Api\PengumumanApiController;
use App\Http\Controllers\Api\DosenAkademikApiController; // <- Tambahan import baru
use App\Http\Controllers\Api\KelolaAkunApiController;    // <- Tambahan import baru

// Rute Publik (Bisa diakses tanpa login)
Route::post('/login', [AuthApiController::class, 'login']);

// Rute Privat (Wajib bawa Token Login di Header)
Route::middleware('auth:sanctum')->group(function () {
    // Auth & Dashboard
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/dashboard', [DashboardApiController::class, 'index']);
    
    // Semua CRUD Mahasiswa dkk
    Route::apiResource('matakuliah', MataKuliahApiController::class);
    Route::apiResource('krs', KrsApiController::class);
    Route::apiResource('nilai', NilaiApiController::class);
    Route::apiResource('presensi', PresensiApiController::class);
    Route::apiResource('pengumuman', PengumumanApiController::class);

    // Rute Dosen Akademik (Hanya butuh Read/Get)
    Route::get('dosen-akademik', [DosenAkademikApiController::class, 'index']);
    Route::get('dosen-akademik/{id}', [DosenAkademikApiController::class, 'show']);

    // Rute Kelola Akun Pribadi
    Route::get('kelola-akun', [KelolaAkunApiController::class, 'index']);
    Route::put('kelola-akun', [KelolaAkunApiController::class, 'update']);
    
    // Endpoint khusus untuk lihat profil sendiri
    Route::get('/user', function (Request $request) {
        return response()->json(['status' => 'success', 'data' => $request->user()]);
    });
    
    // Endpoint Wajib Tugas Bonus A
    Route::get('/identitas', function () {
        return response()->json([
            'nim' => '25.K1.0033',
            'nama' => 'Rafael Sentanu Aruna Septyandaru',
            'foto' => url('uploads/profil/0033.jpg'), 
            'aplikasi' => 'SiAkad-033'
        ], 200);
    });
});