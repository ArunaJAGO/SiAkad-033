@extends('layouts.portal')

@section('pageTitle', 'Pusat Kendali Admin')

@section('content')
<!-- Welcome Banner Admin -->
<div class="bg-gradient-to-r from-[#FB8C00] to-orange-600 rounded-2xl shadow-sm p-6 sm:p-8 text-white flex flex-col sm:flex-row justify-between items-center gap-6 relative overflow-hidden">
    <div class="absolute -right-10 -top-10 opacity-10 text-9xl pointer-events-none">⚙️</div>
    <div class="relative z-10 text-center sm:text-left flex-1">
        <h2 class="text-2xl sm:text-3xl font-black mb-2">Pusat Kendali Utama SiAkad</h2>
        <p class="text-slate-300 text-sm sm:text-base">Kelola data master, jadwal akademik, dan pantau aktivitas sistem secara real-time.</p>
    </div>
<div class="relative z-10 flex-shrink-0 text-center bg-black/70 p-4 rounded-xl border border-white/20 backdrop-blur-sm hover:bg-black/90 transition-colors cursor-pointer"
     onclick="alert('Periode akademik tidak dapat diubah di pertengahan jalan!')">
    <p class="text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">
        Periode Aktif
    </p>
    <p class="text-xl font-extrabold text-[#FB8C00]">
        Ganjil 2026/2027
    </p>
</div>
</div>

<!-- Grid Statistik Master Data (Sekarang Bisa Diklik!) -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
    <a href="{{ url('/admin/pengguna') }}" class="group bg-white p-5 rounded-2xl shadow-sm border border-orange-200/80 flex items-center gap-4 transition-all hover:-translate-y-1 hover:border-orange-300 hover:shadow-md cursor-pointer">
        <div class="w-12 h-12 rounded-xl bg-orange-100 text-[#FB8C00] group-hover:bg-[#FB8C00] group-hover:text-white transition-colors flex items-center justify-center text-2xl flex-shrink-0">👨‍🎓</div>
        <div class="min-w-0">
            <p class="text-[11px] font-bold text-slate-500 uppercase truncate">Mahasiswa</p>
            <p class="text-2xl font-black text-slate-800">3,425</p>
        </div>
    </a>
    <a href="{{ url('/admin/pengguna') }}" class="group bg-white p-5 rounded-2xl shadow-sm border border-orange-200/80 flex items-center gap-4 transition-all hover:-translate-y-1 hover:border-orange-300 hover:shadow-md cursor-pointer">
        <div class="w-12 h-12 rounded-xl bg-orange-100 text-[#FB8C00] group-hover:bg-[#FB8C00] group-hover:text-white transition-colors flex items-center justify-center text-2xl flex-shrink-0">👨‍🏫</div>
        <div class="min-w-0">
            <p class="text-[11px] font-bold text-slate-500 uppercase truncate">Dosen Aktif</p>
            <p class="text-2xl font-black text-slate-800">184</p>
        </div>
    </a>
    <a href="{{ url('/admin/master-data') }}" class="group bg-white p-5 rounded-2xl shadow-sm border border-orange-200/80 flex items-center gap-4 transition-all hover:-translate-y-1 hover:border-emerald-400 hover:shadow-md cursor-pointer">
        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors flex items-center justify-center text-2xl flex-shrink-0">📚</div>
        <div class="min-w-0">
            <p class="text-[11px] font-bold text-slate-500 uppercase truncate">Mata Kuliah</p>
            <p class="text-2xl font-black text-slate-800">420</p>
        </div>
    </a>
    <a href="{{ url('/admin/master-data') }}" class="group bg-white p-5 rounded-2xl shadow-sm border border-orange-200/80 flex items-center gap-4 transition-all hover:-translate-y-1 hover:border-[#FB8C00] hover:shadow-md cursor-pointer">
        <div class="w-12 h-12 rounded-xl bg-orange-100 text-[#FB8C00] group-hover:bg-[#FB8C00] group-hover:text-white transition-colors flex items-center justify-center text-2xl flex-shrink-0">🏢</div>
        <div class="min-w-0">
            <p class="text-[11px] font-bold text-slate-500 uppercase truncate">Ruang Kelas</p>
            <p class="text-2xl font-black text-slate-800">56</p>
        </div>
    </a>
</div>

<!-- Modul Operasional & Log -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
    
    <!-- Panel Jalan Pintas Operasional -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-orange-200/80 overflow-hidden">
        <div class="px-6 py-4 border-b border-orange-100 bg-orange-50/50">
            <h3 class="font-extrabold text-slate-800">Modul Operasional Akademik</h3>
            <p class="text-xs text-slate-400">Akses cepat ke manajemen kurikulum dan penjadwalan.</p>
        </div>
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="{{ url('/admin/jadwal') }}" class="group p-4 rounded-xl border border-orange-200 hover:border-[#FB8C00] hover:bg-orange-50/30 hover:shadow-sm transition-all flex gap-4 items-start cursor-pointer">
                <div class="w-10 h-10 rounded-lg bg-orange-50/30 group-hover:bg-[#FB8C00] group-hover:text-white flex items-center justify-center text-xl transition-colors flex-shrink-0">📅</div>
                <div>
                    <h4 class="font-bold text-slate-700 group-hover:text-[#FB8C00] text-sm transition-colors">Kelola Jadwal Kuliah</h4>
                    <p class="text-xs text-slate-500 mt-1">Plotting dosen, mata kuliah, dan alokasi ruang kelas mingguan.</p>
                </div>
            </a>
            <a href="{{ url('/admin/pengaturan') }}" class="group p-4 rounded-xl border border-orange-200 hover:border-[#FB8C00] hover:bg-orange-50/30 hover:shadow-sm transition-all flex gap-4 items-start cursor-pointer">
                <div class="w-10 h-10 rounded-lg bg-orange-50/30 group-hover:bg-[#FB8C00] group-hover:text-white flex items-center justify-center text-xl transition-colors flex-shrink-0">⚙️</div>
                <div>
                    <h4 class="font-bold text-slate-700 group-hover:text-[#FB8C00] text-sm transition-colors">Tahun Ajaran & KRS</h4>
                    <p class="text-xs text-slate-500 mt-1">Buka/tutup periode pengisian KRS dan ubah semester aktif.</p>
                </div>
            </a>
            <a href="{{ url('/admin/pengumuman') }}" class="group p-4 rounded-xl border border-orange-200 hover:border-[#FB8C00] hover:bg-orange-50/30 hover:shadow-sm transition-all flex gap-4 items-start cursor-pointer">
                <div class="w-10 h-10 rounded-lg bg-orange-50/30 group-hover:bg-[#FB8C00] group-hover:text-white flex items-center justify-center text-xl transition-colors flex-shrink-0">📢</div>
                <div>
                    <h4 class="font-bold text-slate-700 group-hover:text-[#FB8C00] text-sm transition-colors">Pengumuman Sistem</h4>
                    <p class="text-xs text-slate-500 mt-1">Kirim informasi global ke dashboard Mahasiswa & Dosen.</p>
                </div>
            </a>
            <a href="{{ url('/admin/laporan') }}" class="group p-4 rounded-xl border border-orange-200 hover:border-[#FB8C00] hover:bg-orange-50/30 hover:shadow-sm transition-all flex gap-4 items-start cursor-pointer">
                <div class="w-10 h-10 rounded-lg bg-orange-50/30 group-hover:bg-[#FB8C00] group-hover:text-white flex items-center justify-center text-xl transition-colors flex-shrink-0">🖨️</div>
                <div>
                    <h4 class="font-bold text-slate-700 group-hover:text-[#FB8C00] text-sm transition-colors">Cetak Transkrip</h4>
                    <p class="text-xs text-slate-500 mt-1">Validasi dan cetak dokumen resmi rekapitulasi nilai akhir.</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Panel Status Server -->
    <div class="bg-white rounded-2xl shadow-sm border border-orange-200/80 overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b border-orange-100 bg-orange-50/50 flex justify-between items-center cursor-pointer hover:bg-orange-100 transition-colors" title="Lihat detail log server" onclick="alert('Membuka Log Server Monitoring...')">
            <h3 class="font-extrabold text-slate-800">Status Server</h3>
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
        </div>
        <div class="p-6 space-y-4 flex-1">
            <div class="flex justify-between items-center border-b border-orange-100 pb-3">
                <span class="text-xs font-bold text-slate-500">API Gateway</span>
                <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded">Online</span>
            </div>
            <div class="flex justify-between items-center border-b border-orange-100 pb-3">
                <span class="text-xs font-bold text-slate-500">Database Engine</span>
                <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded">MySQL 8.0</span>
            </div>
            <div class="flex justify-between items-center border-b border-orange-100 pb-3">
                <span class="text-xs font-bold text-slate-500">Sesi Keamanan (Sanctum)</span>
                <span id="adminSisaSesi" class="text-xs font-mono font-bold text-[#FB8C00]">120:00</span>
            </div>
        </div>
        <div class="p-4 bg-orange-50 border-t border-orange-100 text-center">
            <button onclick="alert('Memulai unduhan backup database (.sql)...')" class="text-xs font-bold text-[#FB8C00] hover:text-orange-600 hover:bg-orange-100 p-2 rounded-lg transition-colors flex items-center justify-center gap-2 w-full cursor-pointer">
                <span>⬇️</span> Unduh Backup Database
            </button>
        </div>
    </div>

</div>
@endsection