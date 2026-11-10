@extends('layouts.portal')

@section('pageTitle', 'Dashboard Dosen')

@section('content')
<div class="space-y-6">
    <!-- Banner Profil Dosen -->
    <div class="bg-white rounded-2xl shadow-sm border border-orange-200/80 p-5 sm:p-6 flex flex-col lg:flex-row items-center gap-6">
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-5 flex-1 min-w-0 w-full">
            <div class="flex flex-col items-center gap-2 flex-shrink-0">
                <img src="{{ auth()->user()->foto_profil ? asset(auth()->user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=FB8C00&color=fff&size=150' }}"
                     alt="Foto profil dosen"
                     class="w-24 h-24 rounded-full object-cover border-4 border-orange-100 shadow-md">
                <div class="flex flex-wrap justify-center gap-2">
                    <form action="/upload-foto" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="cursor-pointer bg-orange-50 hover:bg-orange-100 text-[#FB8C00] text-[11px] font-bold py-1 px-3 rounded-full border border-orange-200 transition-colors inline-block">
                            📷 Ubah<input type="file" name="foto" class="hidden" onchange="this.form.submit()" accept="image/*">
                        </label>
                    </form>
                    @if(auth()->user()->foto_profil)
                    <form action="/hapus-foto" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto profil?');">
                        @csrf
                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-500 text-[11px] font-bold py-1 px-3 rounded-full border border-red-200 transition-colors inline-block">🗑️ Hapus</button>
                    </form>
                    @endif
                </div>
            </div>
            <div class="text-center sm:text-left flex-1 min-w-0">
                <span class="bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full inline-block mb-2">Dosen Pengajar</span>
                <h3 class="text-xl sm:text-2xl xl:text-3xl font-extrabold text-slate-800 leading-tight">Selamat Datang, {{ auth()->user()->name }} 👋</h3>
                <p class="text-sm text-slate-500 mt-2">Fakultas Teknik Informatika - Universitas Kampus</p>
                @if(session('success'))<p class="text-green-600 text-xs font-bold mt-2 bg-green-50 px-3 py-1 rounded-lg inline-block">✓ {{ session('success') }}</p>@endif
                @error('foto')<p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    <!-- Metric Cards Dosen -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-orange-200/80">
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Mata Kuliah Diampu</p>
            <p class="text-3xl font-extrabold text-[#FB8C00] mt-2">3 Kelas</p>
            <span class="text-xs text-slate-400 mt-2 inline-block">Semester Ganjil 2026</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-orange-200/80">
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Mahasiswa Bimbingan</p>
            <p class="text-3xl font-extrabold text-[#FB8C00] mt-2">14 Mahasiswa</p>
            <span class="text-xs text-slate-400 mt-2 inline-block">Perwali Akademik</span>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-orange-200/80">
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Status Input Nilai</p>
            <p class="text-2xl font-extrabold text-green-600 mt-2">80% Selesai</p>
            <span class="text-xs text-green-500 font-bold mt-2 inline-block">Batas Waktu: 2 Minggu Lagi</span>
        </div>
    </div>

    <!-- Tabel Kelas Mengajar -->
    <div class="bg-white rounded-2xl shadow-sm border border-orange-200/80 overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-orange-100 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 bg-orange-50/50">
            <div>
                <h3 class="font-extrabold text-slate-800 text-lg">Jadwal &amp; Kelas Mengajar Hari Ini</h3>
                <p class="text-xs text-slate-400 mt-1">Ringkasan kelas yang dijadwalkan hari ini.</p>
            </div>
            <span class="text-[11px] text-slate-400 font-medium">Semester Ganjil 2026</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[650px]">
                <thead>
                    <tr class="bg-orange-50 border-b border-orange-100 text-slate-400 text-[11px] uppercase font-bold tracking-wider">
                        <th class="px-6 py-4">Mata Kuliah</th>
                        <th class="px-6 py-4">Ruang / Jadwal</th>
                        <th class="px-6 py-4 text-center">Jumlah Mhs</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium text-slate-700 divide-y divide-orange-100">
                    <tr class="hover:bg-orange-50/30 transition-colors">
                        <td class="px-6 py-4 font-bold text-slate-800">Pemrograman Berorientasi Objek</td>
                        <td class="px-6 py-4 text-slate-500">Lab Komputer 2 (08.00 - 10.30 WIB)</td>
                        <td class="px-6 py-4 text-center">32</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ url('/dosen/nilai') }}" class="inline-block bg-[#FB8C00] text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">Input Nilai</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-orange-50/30 transition-colors">
                        <td class="px-6 py-4 font-bold text-slate-800">Sistem Basis Data (SQL)</td>
                        <td class="px-6 py-4 text-slate-500">Ruang TIF-101 (13.00 - 15.30 WIB)</td>
                        <td class="px-6 py-4 text-center">28</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ url('/dosen/nilai') }}" class="inline-block bg-[#FB8C00] text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">Input Nilai</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
