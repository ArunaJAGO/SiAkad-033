@extends('layouts.portal')
@section('pageTitle', 'KRS Online')
@section('content')
<div class="space-y-6">

    {{-- Notifikasi Sukses / Error --}}
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm p-4 rounded-2xl flex items-center gap-3 shadow-sm">
            <span class="text-xl">✅</span>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 text-sm p-4 rounded-2xl flex items-center gap-3 shadow-sm">
            <span class="text-xl">⚠️</span>
            <div class="font-medium">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Ringkasan KRS --}}
    @php
        $totalSksDiambil = $krsSaya->sum(fn($k) => $k->mataKuliah->sks ?? 0);
        $maxSks = 24;
    @endphp
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-gradient-to-r from-[#FB8C00] to-orange-500 text-white p-5 rounded-2xl shadow-md border border-orange-400">
            <p class="text-xs font-bold uppercase tracking-wider opacity-90">Total SKS Diambil</p>
            <div class="flex items-baseline gap-2 mt-1">
                <span class="text-3xl font-black">{{ $totalSksDiambil }}</span>
                <span class="text-xs text-orange-100 font-semibold">/ {{ $maxSks }} SKS Maksimal</span>
            </div>
            <div class="w-full bg-orange-700/40 rounded-full h-1.5 mt-3 overflow-hidden">
                <div class="bg-white h-1.5 rounded-full" style="width: {{ min(100, ($totalSksDiambil / $maxSks) * 100) }}%"></div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border-2 border-orange-200 flex justify-between items-center">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-orange-500">Mata Kuliah Terdaftar</p>
                <p class="text-3xl font-black text-slate-800 mt-1">{{ $krsSaya->count() }} <span class="text-sm font-semibold text-slate-400">MK</span></p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-orange-100 text-[#FB8C00] flex items-center justify-center text-xl font-bold">
                📝
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border-2 border-orange-200 flex justify-between items-center">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-orange-500">Semester Akademik</p>
                <p class="text-xl font-extrabold text-slate-800 mt-1">Ganjil 2026/2027</p>
                <span class="inline-block mt-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-0.5 rounded-full">KRS Aktif</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl font-bold">
                🎓
            </div>
        </div>
    </div>

    {{-- BAGIAN 1: Mata Kuliah yang Diambil (KRS Saya) --}}
    <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-200 p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 border-b border-orange-100 pb-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-800 flex items-center gap-2">
                    <span>📋</span> Kartu Rencana Studi (KRS Saya)
                </h3>
                <p class="text-xs text-slate-400">Mata kuliah yang Anda daftarkan pada semester ini</p>
            </div>
            <a href="#katalog-matakuliah" class="bg-[#FB8C00] hover:bg-orange-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-md transition-all inline-flex items-center gap-1.5">
                <span>+</span> Tambah Mata Kuliah
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-orange-50/70 border-b border-orange-100 text-[#FB8C00] text-[11px] uppercase font-bold tracking-wider">
                        <th class="p-4">Kode MK</th>
                        <th class="p-4">Mata Kuliah</th>
                        <th class="p-4 text-center">SKS</th>
                        <th class="p-4">Dosen Pengampu</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium text-slate-700 divide-y divide-orange-100/60">
                    @forelse($krsSaya as $krs)
                        <tr class="hover:bg-orange-50/40 transition-colors">
                            <td class="p-4 font-mono text-xs font-bold text-orange-600">
                                {{ $krs->mataKuliah->kode_mk ?? '—' }}
                            </td>
                            <td class="p-4">
                                <span class="font-bold text-slate-800">{{ $krs->mataKuliah->nama_mk ?? 'Mata Kuliah Tidak Ditemukan' }}</span>
                                <span class="block text-xs text-slate-400">Semester {{ $krs->mataKuliah->semester ?? '—' }}</span>
                            </td>
                            <td class="p-4 text-center">
                                <span class="bg-orange-100 text-[#FB8C00] font-black text-xs px-2.5 py-1 rounded-lg">
                                    {{ $krs->mataKuliah->sks ?? 0 }} SKS
                                </span>
                            </td>
                            <td class="p-4 text-xs text-slate-600">
                                {{ $krs->mataKuliah->dosen->name ?? 'Belum Ditentukan' }}
                            </td>
                            <td class="p-4 text-center">
                                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-full border border-blue-200">
                                    {{ $krs->status ?? 'Diajukan' }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <form method="POST" action="{{ route('mahasiswa.krs.destroy', $krs) }}" onsubmit="return confirm('Yakin ingin membatalkan mata kuliah {{ $krs->mataKuliah->nama_mk ?? '' }} dari KRS?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 hover:bg-red-100 text-xs font-bold bg-red-50 px-3 py-1.5 rounded-lg transition-colors">
                                        Batal
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400">
                                <div class="max-w-sm mx-auto space-y-2">
                                    <p class="text-2xl">📭</p>
                                    <p class="font-bold text-slate-700">Belum ada mata kuliah yang diambil</p>
                                    <p class="text-xs text-slate-400">Silakan pilih mata kuliah dari katalog di bawah untuk menambahkan ke KRS Anda.</p>
                                    <a href="#katalog-matakuliah" class="inline-block mt-2 text-xs font-bold text-[#FB8C00] hover:underline">
                                        ↓ Lihat Pilihan Mata Kuliah
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- BAGIAN 2: Katalog Mata Kuliah Tersedia (Data Dummy MataKuliahSeeder) --}}
    <div id="katalog-matakuliah" class="bg-white rounded-2xl shadow-sm border-2 border-orange-200 p-6 scroll-mt-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 border-b border-orange-100 pb-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-800 flex items-center gap-2">
                    <span>📚</span> Katalog Pilihan Mata Kuliah
                    <span class="text-xs bg-orange-100 text-[#FB8C00] font-bold px-2.5 py-0.5 rounded-full">
                        {{ $mataKuliah->total() }} Data Dummy Seeder
                    </span>
                </h3>
                <p class="text-xs text-slate-400">Pilih mata kuliah dari kurikulum untuk ditambahkan ke KRS Anda</p>
            </div>

            {{-- Form Pencarian --}}
            <form method="GET" action="{{ route('mahasiswa.krs') }}#katalog-matakuliah" class="flex gap-2 w-full sm:w-auto">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Cari kode / nama matkul..." 
                    class="rounded-xl border border-orange-200 px-3.5 py-2 text-xs w-full sm:w-60 focus:ring-2 focus:ring-[#FB8C00] focus:outline-none"
                >
                <button type="submit" class="bg-[#1E293B] hover:bg-slate-800 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all">
                    Cari
                </button>
                @if($search)
                    <a href="{{ route('mahasiswa.krs') }}#katalog-matakuliah" class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold px-3 py-2 rounded-xl transition-all">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-orange-50/70 border-b border-orange-100 text-[#FB8C00] text-[11px] uppercase font-bold tracking-wider">
                        <th class="p-4">Kode MK</th>
                        <th class="p-4">Nama Mata Kuliah</th>
                        <th class="p-4 text-center">SKS</th>
                        <th class="p-4 text-center">Semester</th>
                        <th class="p-4">Dosen Pengampu</th>
                        <th class="p-4 text-center">Aksi Ambil</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium text-slate-700 divide-y divide-orange-100/60">
                    @forelse($mataKuliah as $mk)
                        @php
                            $sudahDiambil = in_array($mk->id, $terdaftar);
                        @endphp
                        <tr class="hover:bg-orange-50/40 transition-colors {{ $sudahDiambil ? 'bg-orange-50/20' : '' }}">
                            <td class="p-4 font-mono text-xs font-bold text-orange-600">
                                {{ $mk->kode_mk }}
                            </td>
                            <td class="p-4">
                                <span class="font-bold text-slate-800">{{ $mk->nama_mk }}</span>
                                @if($mk->deskripsi)
                                    <span class="block text-xs text-slate-400 mt-0.5">{{ \Illuminate\Support\Str::limit($mk->deskripsi, 60) }}</span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <span class="bg-orange-100 text-[#FB8C00] font-black text-xs px-2.5 py-1 rounded-lg">
                                    {{ $mk->sks }} SKS
                                </span>
                            </td>
                            <td class="p-4 text-center font-medium">
                                <span class="bg-slate-100 text-slate-700 text-xs px-2.5 py-1 rounded-md font-semibold">
                                    Semester {{ $mk->semester }}
                                </span>
                            </td>
                            <td class="p-4 text-xs text-slate-600">
                                {{ $mk->dosen->name ?? 'Budi Haryadi' }}
                            </td>
                            <td class="p-4 text-center">
                                @if($sudahDiambil)
                                    <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-emerald-200">
                                        <span>✓</span> Sudah Terdaftar
                                    </span>
                                @else
                                    <form method="POST" action="{{ route('mahasiswa.krs.store') }}#katalog-matakuliah">
                                        @csrf
                                        <input type="hidden" name="mata_kuliah_id" value="{{ $mk->id }}">
                                        <button type="submit" class="bg-[#FB8C00] hover:bg-orange-600 text-white text-xs font-bold px-3.5 py-1.5 rounded-lg shadow-sm transition-all inline-flex items-center gap-1">
                                            <span>+</span> Ambil MK
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400">
                                Tidak ada data mata kuliah yang ditemukan{{ $search ? " untuk pencarian '{$search}'" : '' }}.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginasi --}}
        @if($mataKuliah->hasPages())
            <div class="mt-4 pt-4 border-t border-orange-100">
                {{ $mataKuliah->links() }}
            </div>
        @endif
    </div>

</div>
@endsection