@extends('layouts.portal')

@section('pageTitle', 'Ringkasan Akademik')

@section('content')
<div class="space-y-6">
    <!-- Profil dan Kartu Informasi (Banner Dominan Oranye) -->
    <section class="bg-gradient-to-r from-[#FB8C00] via-orange-500 to-amber-500 rounded-2xl shadow-lg shadow-orange-500/20 p-5 sm:p-6 flex flex-col lg:flex-row items-center gap-6 border border-orange-400 relative overflow-hidden">
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-5 flex-1 min-w-0 w-full relative z-10">
            <!-- Foto Profil & Action -->
            <div class="flex flex-col items-center gap-2 flex-shrink-0">
                <img src="{{ auth()->user()->foto_profil ? asset(auth()->user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name ?? 'Mahasiswa') . '&background=FB8C00&color=fff&size=150' }}"
                     alt="Foto profil mahasiswa"
                     class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">

                <div class="flex gap-2">
                    <form action="{{ url('/upload-foto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="cursor-pointer bg-white/90 hover:bg-white text-[#FB8C00] text-[11px] font-bold py-1 px-3 rounded-full shadow-sm transition-colors inline-block">
                            📷 Ubah
                            <input type="file" name="foto" class="hidden" onchange="this.form.submit()" accept="image/jpeg,image/png">
                        </label>
                    </form>

                    @if(auth()->user()->foto_profil)
                        <form action="{{ url('/hapus-foto') }}" method="POST" onsubmit="return confirm('Hapus foto profil?');">
                            @csrf
                            <button type="submit" class="bg-red-500/80 hover:bg-red-600 text-white text-[11px] font-bold py-1 px-3 rounded-full border border-red-400 transition-colors">🗑️ Hapus</button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Identitas Mahasiswa -->
            <div class="text-center sm:text-left flex-1 min-w-0 text-white">
                <span class="bg-emerald-100 text-emerald-800 border border-emerald-300 text-xs font-bold px-3 py-1 rounded-full inline-block mb-2 shadow-sm">
                    ● Mahasiswa Aktif
                </span>
                <h3 class="text-xl xl:text-2xl font-black leading-tight drop-shadow-sm">Selamat Datang, {{ auth()->user()->name }} 👋</h3>
                <p class="text-xs text-orange-100 mt-2">
                    NIM: <span class="font-mono font-bold text-white bg-black/10 px-2 py-0.5 rounded">{{ auth()->user()->username }}</span>
                </p>

                @if(session('success'))
                    <p class="text-green-800 text-xs font-bold mt-2 bg-white/90 px-3 py-1 rounded-lg inline-block shadow-sm">✓ {{ session('success') }}</p>
                @endif
                @if($errors->any())
                    <p class="text-red-700 text-xs font-bold mt-2 bg-white/90 px-3 py-1 rounded-lg inline-block shadow-sm">{{ $errors->first() }}</p>
                @endif
            </div>
        </div>

        <!-- Mini Cards & Timer -->
        <div class="grid grid-cols-2 gap-3 w-full lg:w-[340px] flex-shrink-0 relative z-10">
            <div class="bg-white p-4 rounded-xl border-2 border-orange-200 text-center shadow-sm">
                <p class="text-[10px] font-extrabold uppercase text-orange-500 tracking-wider">Status</p>
                <p class="text-sm font-extrabold text-slate-800 mt-1">Aktif</p>
            </div>

            <div class="bg-white p-4 rounded-xl border-2 border-orange-200 text-center shadow-sm">
                <p class="text-[10px] font-extrabold uppercase text-orange-500 tracking-wider">Semester</p>
                <p class="text-sm font-extrabold text-slate-800 mt-1">Ganjil 2026</p>
            </div>

            <div class="bg-white p-4 rounded-xl border-2 border-orange-200 text-center shadow-sm">
                <p class="text-[10px] font-extrabold uppercase text-orange-500 tracking-wider">SKS Tempuh</p>
                <p class="text-sm font-black text-[#FB8C00] mt-1">84 SKS</p>
            </div>

            <div class="bg-white p-4 rounded-xl border-2 border-orange-200 text-center shadow-sm">
                <p class="text-[10px] font-extrabold uppercase text-orange-500 tracking-wider">IPK Saat Ini</p>
                <p class="text-base font-black text-slate-800 mt-1">3.85 <span class="text-[#FB8C00]">★</span></p>
            </div>

            <div class="col-span-2 bg-[#1E293B] p-4 rounded-xl border-2 border-orange-400 text-left shadow-md">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-[#FB8C00] text-white text-xl flex-shrink-0 shadow-sm">⏳</div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[10px] font-bold uppercase text-orange-400">Sisa Waktu Sesi</p>
                        <p id="sisaWaktu" class="text-lg font-black text-[#FB8C00] mt-0.5" aria-live="polite">Memuat...</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">Durasi sesi: 2 jam</p>
                    </div>
                </div>
                <div class="mt-3 h-2 rounded-full bg-slate-800 overflow-hidden border border-slate-700">
                    <div id="progressWaktu" class="h-full rounded-full bg-[#FB8C00] transition-all duration-1000 shadow-sm" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabel Transkrip Nilai -->
    <section class="bg-white rounded-2xl shadow-sm border border-orange-200/80 overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-orange-100 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-orange-50/40">
            <div>
                <h3 class="font-extrabold text-slate-800">Transkrip Nilai Semester</h3>
                <p class="text-xs text-slate-400">Daftar mata kuliah yang diambil semester ini.</p>
            </div>
            <button type="button" onclick="window.print()" class="self-start sm:self-auto bg-[#FB8C00] hover:bg-orange-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/20 transition-all flex items-center gap-2">
                🖨️ Cetak KHS
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-orange-50/70 border-b border-orange-100 text-[#FB8C00] text-[11px] uppercase font-bold tracking-wider">
                        <th class="px-6 py-3.5">Kode MK</th>
                        <th class="px-6 py-3.5">Mata Kuliah</th>
                        <th class="px-6 py-3.5 text-center">SKS</th>
                        <th class="px-6 py-3.5 text-center">Nilai</th>
                        <th class="px-6 py-3.5 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium text-slate-700 divide-y divide-orange-100/60">
                    <tr class="hover:bg-orange-50/50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-slate-400">TIF201</td>
                        <td class="px-6 py-4 font-bold text-slate-800">Pemrograman Berorientasi Objek (Java)</td>
                        <td class="px-6 py-4 text-center">3</td>
                        <td class="px-6 py-4 text-center font-extrabold text-[#FB8C00]">A</td>
                        <td class="px-6 py-4 text-center"><span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">Lulus</span></td>
                    </tr>
                    <tr class="hover:bg-orange-50/50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-slate-400">TIF202</td>
                        <td class="px-6 py-4 font-bold text-slate-800">Sistem Basis Data (SQL)</td>
                        <td class="px-6 py-4 text-center">3</td>
                        <td class="px-6 py-4 text-center font-extrabold text-[#FB8C00]">A</td>
                        <td class="px-6 py-4 text-center"><span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">Lulus</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection