@extends('layouts.portal')
@section('pageTitle', 'Laporan & Validasi')
@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-2xl shadow-sm border border-orange-200/80 p-6 flex flex-col justify-between">
        <div>
            <div class="text-4xl mb-3">📑</div>
            <h3 class="font-extrabold text-slate-800 text-lg">Cetak Transkrip</h3>
            <p class="text-xs text-slate-500 mt-1">Cetak rekapitulasi nilai akhir mahasiswa untuk keperluan Yudisium/Lulus.</p>
        </div>
        <div class="mt-6 flex gap-2">
            <input type="text" placeholder="Masukkan NIM" class="w-full px-3 py-2 text-sm border border-orange-200 rounded-xl outline-none focus:border-[#FB8C00]">
            <button class="bg-[#FB8C00] text-white p-2 rounded-xl hover:bg-orange-600">🖨️</button>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-orange-200/80 p-6 flex flex-col justify-between">
        <div>
            <div class="text-4xl mb-3">📝</div>
            <h3 class="font-extrabold text-slate-800 text-lg">Rekap Presensi</h3>
            <p class="text-xs text-slate-500 mt-1">Unduh laporan kehadiran mahasiswa per mata kuliah format Excel/PDF.</p>
        </div>
        <button class="w-full mt-6 bg-orange-50/30 hover:bg-orange-100 text-slate-700 text-sm font-bold py-2.5 rounded-xl transition-colors">Lihat Daftar MK</button>
    </div>
</div>
@endsection