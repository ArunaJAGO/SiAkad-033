@extends('layouts.portal')
@section('pageTitle', 'Pengaturan Sistem')
@section('content')
<div class="max-w-3xl bg-white rounded-2xl shadow-sm border border-orange-200/80 overflow-hidden">
    <div class="px-6 py-4 border-b border-orange-100 bg-orange-50/50">
        <h3 class="font-extrabold text-slate-800 flex items-center gap-2">⚙️ Konfigurasi Periode Akademik</h3>
    </div>
    <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tahun Ajaran Aktif</label>
                <select class="w-full px-4 py-3 rounded-xl border border-orange-200 bg-orange-50 outline-none text-sm font-semibold">
                    <option>2026/2027</option>
                    <option>2027/2028</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Semester Aktif</label>
                <select class="w-full px-4 py-3 rounded-xl border border-orange-200 bg-orange-50 outline-none text-sm font-semibold">
                    <option>Ganjil</option>
                    <option>Genap</option>
                </select>
            </div>
        </div>
        
        <hr class="border-orange-100">
        
        <div>
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Status Pengisian KRS Mahasiswa</label>
            <div class="flex gap-4">
                <label class="flex-1 cursor-pointer">
                    <input type="radio" name="krs_status" class="peer hidden" checked>
                    <div class="p-4 border-2 border-orange-200 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-50 text-center transition-all">
                        <span class="font-bold text-green-700 block">DIBUKA</span>
                        <span class="text-xs text-slate-500">Mahasiswa dapat mengisi KRS</span>
                    </div>
                </label>
                <label class="flex-1 cursor-pointer">
                    <input type="radio" name="krs_status" class="peer hidden">
                    <div class="p-4 border-2 border-orange-200 rounded-xl peer-checked:border-red-500 peer-checked:bg-red-50 text-center transition-all">
                        <span class="font-bold text-red-700 block">DITUTUP</span>
                        <span class="text-xs text-slate-500">Akses KRS dikunci</span>
                    </div>
                </label>
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button class="bg-[#FB8C00] hover:bg-orange-600 text-white text-sm font-bold px-8 py-3 rounded-xl shadow-md transition-all">Simpan Konfigurasi</button>
        </div>
    </div>
</div>
@endsection