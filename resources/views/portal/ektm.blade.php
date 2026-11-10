@extends('layouts.portal')
@section('pageTitle', 'Kartu Tanda Mahasiswa Elektronik')
@section('content')

<div class="flex justify-center mt-8">
    <!-- ID Card Container -->
    <div class="w-[350px] bg-white rounded-2xl shadow-xl border border-orange-200 overflow-hidden">
        
        <!-- Header KTM -->
        <div class="bg-gradient-to-r from-[#FB8C00] to-orange-500 p-5 text-center text-white relative">
            <h2 class="text-lg font-black tracking-wider uppercase">SiAkad Modern</h2>
            <p class="text-[10px] font-medium opacity-90 uppercase tracking-widest">Kartu Tanda Mahasiswa</p>
        </div>

        <!-- Body KTM -->
        <div class="p-6 flex flex-col items-center">
            <!-- Foto Profil (Dummy kalau kosong) -->
            <div class="w-28 h-32 bg-slate-200 rounded-xl mb-4 border-4 border-white shadow-md overflow-hidden object-cover">
                @if($user->foto_profil)
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto" class="w-full h-full object-cover">
                @else
                    <svg class="w-full h-full text-slate-400 p-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                @endif
            </div>

            <!-- Identitas -->
            <h3 class="text-xl font-extrabold text-slate-800 text-center uppercase">{{ $user->name }}</h3>
            <div class="mt-4 w-full bg-orange-50 p-3 rounded-xl border border-orange-100">
                <div class="grid grid-cols-3 gap-1 mb-2">
                    <div class="text-xs font-bold text-slate-400">NIM</div>
                    <div class="text-xs font-mono font-bold text-slate-700 col-span-2">: {{ explode('@', $user->username)[0] }}</div>
                </div>
                <div class="grid grid-cols-3 gap-1 mb-2">
                    <div class="text-xs font-bold text-slate-400">FAKULTAS</div>
                    <div class="text-xs font-bold text-slate-700 col-span-2">: Teknik Informatika</div>
                </div>
                <div class="grid grid-cols-3 gap-1">
                    <div class="text-xs font-bold text-slate-400">STATUS</div>
                    <div class="text-xs font-bold text-green-600 col-span-2">: Aktif</div>
                </div>
            </div>
            
            <div class="mt-6 border-t border-dashed border-slate-300 w-full pt-4 text-center">
                <p class="text-[10px] text-slate-400">Kartu ini adalah identitas resmi yang sah digunakan di lingkungan kampus.</p>
            </div>
        </div>
    </div>
</div>
@endsection