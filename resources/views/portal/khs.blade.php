@extends('layouts.portal')
@section('pageTitle', 'KHS & Transkrip')
@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-gradient-to-r from-[#FB8C00] to-orange-500 text-white p-5 rounded-2xl shadow-md border border-orange-400">
            <p class="text-xs font-bold uppercase opacity-90">IPK Kumulatif</p>
            <p class="text-3xl font-black mt-1">3.85 ★</p>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow-sm border-2 border-orange-200">
            <p class="text-xs font-extrabold uppercase text-orange-500">Total SKS Tempuh</p>
            <p class="text-3xl font-black text-slate-800 mt-1">84 SKS</p>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow-sm border-2 border-orange-200">
            <p class="text-xs font-extrabold uppercase text-orange-500">Semester Aktif</p>
            <p class="text-3xl font-black text-slate-800 mt-1">4</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-200 p-6">
        <div class="flex justify-between items-center mb-4 pb-3 border-b border-orange-100">
            <h3 class="text-lg font-extrabold text-slate-800">Hasil Studi Semester Ganjil</h3>
            <button onclick="window.print()" class="bg-[#1E293B] text-white text-xs font-bold px-4 py-2 rounded-xl hover:bg-slate-800">🖨️ Cetak KHS</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-orange-50/70 border-b border-orange-100 text-[#FB8C00] text-[11px] uppercase font-bold tracking-wider">
                        <th class="p-4">Kode MK</th>
                        <th class="p-4">Mata Kuliah</th>
                        <th class="p-4 text-center">SKS</th>
                        <th class="p-4 text-center">Nilai</th>
                        <th class="p-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-orange-100/60">
                    <tr class="hover:bg-orange-50/40">
                        <td class="p-4 font-mono text-xs text-slate-400">TIF201</td>
                        <td class="p-4 font-bold text-slate-800">Pemrograman Berorientasi Objek</td>
                        <td class="p-4 text-center">3</td>
                        <td class="p-4 text-center font-black text-[#FB8C00]">A</td>
                        <td class="p-4 text-center"><span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">Lulus</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection