@extends('layouts.portal')

@section('pageTitle', isset($isDosen) && $isDosen ? 'Profil Dosen' : 'Profil Mahasiswa')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Kartu Profil Kiri (Oranye Dominan) -->
    <div class="lg:col-span-1">
        <div class="bg-gradient-to-b from-[#FB8C00] via-orange-500 to-orange-600 rounded-2xl shadow-lg shadow-orange-500/20 border border-orange-400 p-6 text-center text-white relative overflow-hidden">
            <div class="relative z-10 flex flex-col items-center">
                <img src="{{ auth()->user()->foto_profil ? asset(auth()->user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=ffffff&color=FB8C00&size=150' }}" 
                     alt="Foto Profil" 
                     class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md mb-4">
                
                <h3 class="text-xl font-black drop-shadow-sm">{{ auth()->user()->name }}</h3>
                <span class="bg-emerald-100 text-emerald-800 border border-emerald-300 text-xs font-bold px-3 py-1 rounded-full inline-block mt-2 shadow-sm">
                    ● {{ isset($isDosen) && $isDosen ? 'Dosen Pengajar' : 'Mahasiswa Aktif' }}
                </span>

                <div class="mt-6 w-full space-y-2">
                    <form action="{{ url('/upload-foto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="cursor-pointer block w-full bg-white/20 hover:bg-white hover:text-[#FB8C00] text-white text-xs font-bold py-2.5 px-4 rounded-xl transition-all border border-white/30 backdrop-blur-sm shadow-sm">
                            📷 Ganti Foto Profil
                            <input type="file" name="foto" class="hidden" onchange="this.form.submit()" accept="image/jpeg,image/png">
                        </label>
                    </form>
                </div>
                <p class="text-[10px] text-orange-100 mt-3 font-medium">Format JPG/PNG, ukuran maksimum 2 MB.</p>
            </div>
        </div>
    </div>

    <!-- Form Kanan (Aksen Oranye) -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-200 p-6 sm:p-8">
            <div class="mb-6 border-b border-orange-100 pb-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-orange-100 text-[#FB8C00] flex items-center justify-center text-xl shadow-sm">👤</div>
                <div>
                    <h3 class="text-lg font-extrabold text-slate-800">Informasi Akun</h3>
                    <p class="text-xs text-slate-400">Perbarui informasi nama dan kata sandi Anda.</p>
                </div>
            </div>

            <form action="{{ isset($isDosen) && $isDosen ? route('dosen.profil.update') : url('/mahasiswa/profil') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-[11px] font-extrabold text-orange-600 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full px-4 py-3 bg-orange-50/50 border border-orange-200 rounded-xl text-sm font-bold text-slate-700 focus:outline-none focus:border-[#FB8C00] focus:ring-1 focus:ring-[#FB8C00] transition-all">
                </div>

                <div>
                    <label class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-2">Username / NIM</label>
                    <input type="text" name="username" value="{{ auth()->user()->username }}" class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-sm font-bold text-slate-400 cursor-not-allowed" readonly>
                </div>

                <div>
                    <label class="block text-[11px] font-extrabold text-orange-600 uppercase tracking-wider mb-2">Kata Sandi Baru (Opsional)</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah kata sandi" class="w-full px-4 py-3 bg-orange-50/50 border border-orange-200 rounded-xl text-sm font-bold text-slate-700 focus:outline-none focus:border-[#FB8C00] focus:ring-1 focus:ring-[#FB8C00] transition-all">
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="bg-[#FB8C00] hover:bg-orange-600 text-white text-sm font-bold px-8 py-3 rounded-xl shadow-md shadow-orange-500/20 transition-all flex items-center gap-2">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection