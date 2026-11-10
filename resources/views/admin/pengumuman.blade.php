@extends('layouts.portal')
@section('pageTitle', 'Pengumuman Global')
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Form Buat Pengumuman -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden h-fit">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-extrabold text-slate-800">Kirim Pengumuman Baru</h3>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Judul Pengumuman</label>
                <input type="text" placeholder="Contoh: Libur Nasional..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 outline-none text-sm font-bold text-slate-700">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Isi Pesan</label>
                <textarea rows="4" placeholder="Tulis rincian pengumuman di sini..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 outline-none text-sm text-slate-700"></textarea>
            </div>
            <button class="w-full bg-[#FB8C00] text-white text-sm font-bold px-6 py-3 rounded-xl hover:bg-orange-600 transition-colors">📢 Siarkan Sekarang</button>
        </div>
    </div>

    <!-- Riwayat Pengumuman -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-extrabold text-slate-800">Riwayat Pengumuman</h3>
        </div>
        <div class="divide-y divide-slate-100">
            <div class="p-6 hover:bg-slate-50 transition-colors">
                <span class="text-[10px] font-bold text-[#FB8C00] uppercase tracking-wider">1 Hari yang lalu</span>
                <h4 class="font-bold text-slate-800 mt-1">Batas Akhir Pembayaran UKT</h4>
                <p class="text-sm text-slate-500 mt-1 line-clamp-2">Harap segera melunasi pembayaran UKT semester Ganjil 2026/2027 sebelum tanggal 20 Oktober.</p>
                <button class="text-red-500 hover:underline text-xs font-bold mt-2">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection