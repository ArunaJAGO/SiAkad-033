@extends('layouts.portal')
@section('pageTitle', 'Presensi Online')
@section('content')
<div class="bg-white rounded-2xl shadow-sm border-2 border-orange-200 p-6">
    <div class="mb-6 border-b border-orange-100 pb-4">
        <h3 class="text-lg font-extrabold text-slate-800">Rekap Kehadiran Perkuliahan</h3>
        <p class="text-xs text-slate-400">Persentase kehadiran kamu di semester ini.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="p-5 bg-orange-50/50 rounded-2xl border-2 border-orange-200 flex justify-between items-center">
            <div>
                <h4 class="font-bold text-slate-800">Pemrograman Berorientasi Objek</h4>
                <p class="text-xs text-orange-600 font-bold mt-1">Kehadiran: 100% (14/14 Pertemuan)</p>
            </div>
            <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full border border-emerald-200">Aman</span>
        </div>
        <div class="p-5 bg-orange-50/50 rounded-2xl border-2 border-orange-200 flex justify-between items-center">
            <div>
                <h4 class="font-bold text-slate-800">Sistem Basis Data</h4>
                <p class="text-xs text-orange-600 font-bold mt-1">Kehadiran: 100% (14/14 Pertemuan)</p>
            </div>
            <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full border border-emerald-200">Aman</span>
        </div>
    </div>
</div>
@endsection