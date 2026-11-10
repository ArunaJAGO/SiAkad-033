@extends('layouts.portal')
@section('pageTitle', 'Master Data Akademik')
@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-orange-200/80 overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-orange-100 bg-orange-50/50 flex flex-col sm:flex-row justify-between sm:items-center gap-3">
        <div>
            <h3 class="font-extrabold text-slate-800 flex items-center gap-2">📚 Data Master Mata Kuliah</h3>
            <p class="text-xs text-slate-400 mt-0.5">Daftar mata kuliah yang terdaftar di kurikulum SiAkad ({{ $mataKuliah->count() }} Mata Kuliah)</p>
        </div>
        <span class="bg-[#FB8C00] text-white text-xs font-bold px-3.5 py-2 rounded-xl shadow-sm inline-flex items-center gap-1.5 self-start sm:self-auto">
            <span>✨</span> Data Dummy MataKuliahSeeder
        </span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-orange-50 text-slate-500 text-xs uppercase tracking-wider border-b border-orange-200">
                    <th class="p-4 font-bold">Kode MK</th>
                    <th class="p-4 font-bold">Nama Mata Kuliah</th>
                    <th class="p-4 font-bold text-center">SKS</th>
                    <th class="p-4 font-bold text-center">Semester</th>
                    <th class="p-4 font-bold">Dosen Pengampu</th>
                </tr>
            </thead>
            <tbody class="text-sm text-slate-700 divide-y divide-orange-100">
                @forelse($mataKuliah as $mk)
                <tr class="hover:bg-orange-50/60 transition-colors">
                    <td class="p-4 font-mono font-bold text-orange-600">{{ $mk->kode_mk }}</td>
                    <td class="p-4 font-bold text-slate-800">{{ $mk->nama_mk }}</td>
                    <td class="p-4 text-center">
                        <span class="bg-orange-100 text-[#FB8C00] font-black px-2.5 py-1 rounded-lg text-xs">{{ $mk->sks }} SKS</span>
                    </td>
                    <td class="p-4 text-center font-medium">
                        <span class="bg-slate-100 text-slate-700 text-xs font-semibold px-2.5 py-1 rounded-md">Semester {{ $mk->semester }}</span>
                    </td>
                    <td class="p-4 text-slate-600 text-xs">
                        {{ $mk->dosen->name ?? 'Belum Ditentukan' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-slate-400">Belum ada data mata kuliah. Jalankan <code>php artisan db:seed --class=MataKuliahSeeder</code></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection