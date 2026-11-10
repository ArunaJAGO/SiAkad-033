@extends('layouts.portal')
@section('pageTitle', 'Jadwal Akademik')
@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-orange-200/80 overflow-hidden">
    <div class="px-6 py-4 border-b border-orange-100 bg-orange-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
        <h3 class="font-extrabold text-slate-800 flex items-center gap-2">📅 Plotting Jadwal Kuliah</h3>
        <select class="px-4 py-2 text-sm border border-orange-200 rounded-xl focus:outline-none focus:border-[#FB8C00] font-bold text-slate-700">
            <option>Pilih Hari: Senin</option>
            <option>Pilih Hari: Selasa</option>
        </select>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-orange-50 text-slate-500 text-xs uppercase tracking-wider border-b border-orange-200">
                    <th class="p-4 font-bold">Jam</th>
                    <th class="p-4 font-bold">Mata Kuliah</th>
                    <th class="p-4 font-bold">Dosen Pengampu</th>
                    <th class="p-4 font-bold">Ruang</th>
                    <th class="p-4 font-bold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-slate-700 divide-y divide-orange-100">
                <tr class="hover:bg-orange-50">
                    <td class="p-4 font-bold text-[#FB8C00]">07:00 - 08:40</td>
                    <td class="p-4 font-bold">Algoritma & Struktur Data <br><span class="text-xs font-normal text-slate-400">Kelas: A11.4101</span></td>
                    <td class="p-4">Dr. Budi Dosen, M.Kom</td>
                    <td class="p-4 font-mono">H.4.2</td>
                    <td class="p-4 text-center">
                        <button class="text-red-500 hover:underline font-bold text-xs">Kosongkan</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="p-4 bg-orange-50 border-t border-orange-100 text-center">
        <button class="bg-[#FB8C00] text-white text-sm font-bold px-4 py-2 rounded-xl hover:bg-orange-600">+ Tambah Jadwal Baru</button>
    </div>
</div>
@endsection