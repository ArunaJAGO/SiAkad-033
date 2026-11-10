<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenAkademikController;
use App\Http\Controllers\KelolaAkunController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CekRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Register tidak dibutuhkan untuk alur UTS, tetapi route lama dibiarkan tersedia.
    Route::get('/register', fn () => redirect('/login'));

    Route::middleware('auth')->group(function () {
    Route::post('/upload-foto', [UserController::class, 'uploadFoto'])->name('upload.foto');
    Route::post('/hapus-foto', [UserController::class, 'hapusFoto'])->name('hapus.foto');
    });

    Route::middleware([CekRole::class . ':Mahasiswa'])->prefix('mahasiswa')->group(function () {
    Route::get('/profil', [PortalController::class, 'profil'])->name('mahasiswa.profil');
    Route::put('/profil', [PortalController::class, 'updateProfil'])->name('mahasiswa.profil.update');
    Route::get('/krs', [PortalController::class, 'krs'])->name('mahasiswa.krs');
    Route::post('/krs', [PortalController::class, 'storeKrs'])->name('mahasiswa.krs.store');
    Route::delete('/krs/{krs}', [PortalController::class, 'destroyKrs'])->name('mahasiswa.krs.destroy');
    Route::get('/khs', [PortalController::class, 'khs'])->name('mahasiswa.khs');
    Route::get('/presensi', [PortalController::class, 'presensi'])->name('mahasiswa.presensi');
    Route::get('/ektm', [PortalController::class, 'ektm'])->name('mahasiswa.ektm');
    Route::get('/pengumuman', [PortalController::class, 'pengumuman'])->name('mahasiswa.pengumuman');
    Route::get('/pengaturan', fn () => view('portal.pengaturan'))->name('mahasiswa.pengaturan');
    Route::post('/pengaturan/password', [PortalController::class, 'updatePassword'])->name('mahasiswa.pengaturan.password');
    });

    // Alias dashboard mahasiswa lama tetap tersedia dengan proteksi role.
    Route::get('/dashboard', [DashboardController::class, 'mahasiswaDashboard'])->middleware(CekRole::class . ':Mahasiswa')->name('mahasiswa.dashboard');

    Route::middleware([CekRole::class . ':Dosen'])->prefix('dosen')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dosenDashboard'])->name('dosen.dashboard');
    Route::get('/jadwal', [DosenAkademikController::class, 'jadwal'])->name('dosen.jadwal');
    Route::get('/mata-kuliah', [DosenAkademikController::class, 'mataKuliah'])->name('dosen.mata-kuliah.index');
    Route::get('/mata-kuliah/tambah', [DosenAkademikController::class, 'createMataKuliah'])->name('dosen.mata-kuliah.create');
    Route::post('/mata-kuliah', [DosenAkademikController::class, 'storeMataKuliah'])->name('dosen.mata-kuliah.store');
    Route::get('/mata-kuliah/{mataKuliah}/edit', [DosenAkademikController::class, 'editMataKuliah'])->name('dosen.mata-kuliah.edit');
    Route::put('/mata-kuliah/{mataKuliah}', [DosenAkademikController::class, 'updateMataKuliah'])->name('dosen.mata-kuliah.update');
    Route::delete('/mata-kuliah/{mataKuliah}', [DosenAkademikController::class, 'destroyMataKuliah'])->name('dosen.mata-kuliah.destroy');
    Route::get('/mahasiswa-bimbingan', [DosenAkademikController::class, 'mahasiswaBimbingan'])->name('dosen.mahasiswa-bimbingan');
    Route::get('/nilai', [DosenAkademikController::class, 'nilai'])->name('dosen.nilai.index');
    Route::get('/nilai/tambah', [DosenAkademikController::class, 'createNilai'])->name('dosen.nilai.create');
    Route::post('/nilai', [DosenAkademikController::class, 'storeNilai'])->name('dosen.nilai.store');
    Route::get('/nilai/{nilai}/edit', [DosenAkademikController::class, 'editNilai'])->name('dosen.nilai.edit');
    Route::put('/nilai/{nilai}', [DosenAkademikController::class, 'updateNilai'])->name('dosen.nilai.update');
    Route::delete('/nilai/{nilai}', [DosenAkademikController::class, 'destroyNilai'])->name('dosen.nilai.destroy');
    Route::get('/presensi', [DosenAkademikController::class, 'presensi'])->name('dosen.presensi.index');
    Route::get('/presensi/tambah', [DosenAkademikController::class, 'createPresensi'])->name('dosen.presensi.create');
    Route::post('/presensi', [DosenAkademikController::class, 'storePresensi'])->name('dosen.presensi.store');
    Route::get('/presensi/{presensi}/edit', [DosenAkademikController::class, 'editPresensi'])->name('dosen.presensi.edit');
    Route::put('/presensi/{presensi}', [DosenAkademikController::class, 'updatePresensi'])->name('dosen.presensi.update');
    Route::delete('/presensi/{presensi}', [DosenAkademikController::class, 'destroyPresensi'])->name('dosen.presensi.destroy');
    Route::get('/pengumuman', [DosenAkademikController::class, 'pengumuman'])->name('dosen.pengumuman.index');
    Route::get('/pengumuman/tambah', [DosenAkademikController::class, 'createPengumuman'])->name('dosen.pengumuman.create');
    Route::post('/pengumuman', [DosenAkademikController::class, 'storePengumuman'])->name('dosen.pengumuman.store');
    Route::get('/pengumuman/{pengumuman}/edit', [DosenAkademikController::class, 'editPengumuman'])->name('dosen.pengumuman.edit');
    Route::put('/pengumuman/{pengumuman}', [DosenAkademikController::class, 'updatePengumuman'])->name('dosen.pengumuman.update');
    Route::delete('/pengumuman/{pengumuman}', [DosenAkademikController::class, 'destroyPengumuman'])->name('dosen.pengumuman.destroy');
    Route::get('/kalender', [DosenAkademikController::class, 'kalender'])->name('dosen.kalender');
    Route::get('/profil', [DosenAkademikController::class, 'profil'])->name('dosen.profil');
    Route::put('/profil', [DosenAkademikController::class, 'updateProfil'])->name('dosen.profil.update');
    Route::get('/pengaturan', [DosenAkademikController::class, 'pengaturan'])->name('dosen.pengaturan');
    Route::post('/pengaturan/password', [PortalController::class, 'updatePassword'])->name('dosen.pengaturan.password');
    });

    Route::middleware([CekRole::class . ':Admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    // CRUD akun Mahasiswa.
    Route::get('/mahasiswa', [KelolaAkunController::class, 'mahasiswaIndex'])->name('admin.mahasiswa.index');
    Route::get('/mahasiswa/tambah', [KelolaAkunController::class, 'mahasiswaCreate'])->name('admin.mahasiswa.create');
    Route::post('/mahasiswa', [KelolaAkunController::class, 'mahasiswaStore'])->name('admin.mahasiswa.store');
    Route::get('/mahasiswa/{user}/edit', [KelolaAkunController::class, 'mahasiswaEdit'])->name('admin.mahasiswa.edit');
    Route::put('/mahasiswa/{user}', [KelolaAkunController::class, 'mahasiswaUpdate'])->name('admin.mahasiswa.update');
    Route::delete('/mahasiswa/{user}', [KelolaAkunController::class, 'mahasiswaDestroy'])->name('admin.mahasiswa.destroy');

    // CRUD akun Dosen.
    Route::get('/dosen', [KelolaAkunController::class, 'dosenIndex'])->name('admin.dosen.index');
    Route::get('/dosen/tambah', [KelolaAkunController::class, 'dosenCreate'])->name('admin.dosen.create');
    Route::post('/dosen', [KelolaAkunController::class, 'dosenStore'])->name('admin.dosen.store');
    Route::get('/dosen/{user}/edit', [KelolaAkunController::class, 'dosenEdit'])->name('admin.dosen.edit');
    Route::put('/dosen/{user}', [KelolaAkunController::class, 'dosenUpdate'])->name('admin.dosen.update');
    Route::delete('/dosen/{user}', [KelolaAkunController::class, 'dosenDestroy'])->name('admin.dosen.destroy');

    // Menu kelola pengguna lama tetap aktif.
    Route::get('/kelola-pengguna', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/kelola-pengguna/tambah', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/kelola-pengguna', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/kelola-pengguna/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/kelola-pengguna/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/kelola-pengguna/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Alias URL lama yang sudah dipakai beberapa Blade lama.
    Route::middleware([CekRole::class . ':Admin'])->group(function () {
    Route::get('/kelola-pengguna', [UserController::class, 'index']);
    Route::get('/kelola-pengguna/tambah', [UserController::class, 'create']);
    Route::post('/kelola-pengguna', [UserController::class, 'store']);
    Route::get('/kelola-pengguna/{user}/edit', [UserController::class, 'edit']);
    Route::put('/kelola-pengguna/{user}', [UserController::class, 'update']);
    Route::delete('/kelola-pengguna/{user}', [UserController::class, 'destroy']);
    // Rute Profil Admin (Bisa dibuka dan Disimpan)
    Route::get('/admin/profil', [AdminController::class, 'profil']);
    Route::post('/admin/profil/update', [AdminController::class, 'updateProfil']);

    Route::middleware(['auth'])->group(function () {
    // ... rute dashboard dan profil biarkan saja ...
    Route::get('/admin/pengguna', [App\Http\Controllers\AdminController::class, 'pengguna']);
    Route::get('/admin/master-data', function() { 
        $mataKuliah = \App\Models\MataKuliah::with('dosen')->orderBy('semester')->orderBy('kode_mk')->get();
        return view('admin.master-data', compact('mataKuliah')); 
    });
    Route::get('/admin/jadwal', function() { return view('admin.jadwal'); });
    Route::get('/admin/pengaturan', function() { return view('admin.pengaturan'); });
    Route::get('/admin/pengumuman', function() { return view('admin.pengumuman'); });
    Route::get('/admin/laporan', function() { return view('admin.laporan'); });
    });
    Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profil', [AdminController::class, 'profil']);
    Route::post('/admin/profil/update', [AdminController::class, 'updateProfil']);
    });
});
