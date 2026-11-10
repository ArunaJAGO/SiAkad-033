@extends('layouts.portal')

@section('pageTitle', 'Profil Administrator')

@section('content')
<div class="max-w-4xl mx-auto rounded-2xl overflow-hidden
            border-2 border-orange-400
            bg-orange-50 shadow-xl shadow-orange-500/10">

    <!-- HEADER ORANYE -->
    <div class="relative overflow-hidden
                bg-gradient-to-r from-[#FB8C00] via-orange-500 to-orange-600
                px-6 py-6 sm:px-8">

        <div class="absolute -right-10 -top-16 w-48 h-48
                    rounded-full bg-white/10"></div>

        <div class="absolute right-20 -bottom-16 w-32 h-32
                    rounded-full bg-white/10"></div>

        <div class="relative z-10 flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl
                        bg-slate-900/15 border border-slate-900/10
                        flex items-center justify-center text-3xl">
                👤
            </div>

            <div>
                <span class="inline-block text-[10px] font-extrabold
                             uppercase tracking-[0.2em]
                             text-slate-900/70 mb-1">
                    SI AKAD MODERN
                </span>

                <h3 class="text-xl sm:text-2xl font-black text-white">
                    Pengaturan Profil Admin
                </h3>

                <p class="text-sm text-white/90 mt-1">
                    Kelola identitas dan keamanan akun administrator.
                </p>
            </div>
        </div>
    </div>

    <!-- KONTEN FORM -->
    <div class="p-5 sm:p-8 bg-orange-50/80">

        <form action="{{ url('/admin/profil/update') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-7">

            @csrf

            <!-- FOTO PROFIL -->
            <section class="rounded-2xl border-2 border-orange-200
                            bg-white p-5 sm:p-6
                            shadow-sm shadow-orange-500/5">

                <div class="flex items-center gap-2 mb-5">
                    <span class="w-1.5 h-6 rounded-full bg-[#FB8C00]"></span>
                    <h4 class="font-extrabold text-slate-800">
                        Foto Profil
                    </h4>
                </div>

                <div class="flex flex-col sm:flex-row items-center
                            sm:items-start gap-5">

                    <div class="relative flex-shrink-0">
                        <div class="absolute -inset-1.5 rounded-full
                                    bg-gradient-to-br from-[#FB8C00]
                                    to-orange-300 opacity-40 blur-sm"></div>

                        <img
                            src="{{ auth()->user()->foto_profil
                                ? asset(auth()->user()->foto_profil)
                                : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=FB8C00&color=fff' }}"
                            alt="Foto Admin"
                            class="relative w-28 h-28 rounded-full
                                   object-cover border-4 border-[#FB8C00]
                                   shadow-lg">
                    </div>

                    <div class="flex-1 text-center sm:text-left">
                        <p class="text-base font-extrabold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs font-semibold text-orange-600 mt-1">
                            Administrator SiAkad
                        </p>

                        <p class="text-xs text-slate-500 mt-2 mb-4">
                            Gunakan foto yang jelas untuk identitas akun Anda.
                        </p>

                        <label class="cursor-pointer inline-flex items-center
                                      gap-2 bg-[#FB8C00] hover:bg-orange-600
                                      text-white text-xs font-extrabold
                                      py-2.5 px-5 rounded-xl
                                      shadow-md shadow-orange-500/20
                                      transition-all hover:-translate-y-0.5">

                            📸 Ganti Foto Profil

                            <input
                                type="file"
                                name="foto_profil"
                                class="hidden"
                                accept="image/jpeg,image/png">
                        </label>

                        <p class="text-[10px] text-slate-400 mt-2">
                            Format JPG atau PNG. Maksimal 2 MB.
                        </p>
                    </div>
                </div>
            </section>

            <!-- INFORMASI AKUN -->
            <section class="rounded-2xl border-2 border-orange-200
                            bg-white p-5 sm:p-6 shadow-sm">

                <div class="flex items-center gap-2 mb-6">
                    <span class="w-1.5 h-6 rounded-full bg-[#FB8C00]"></span>
                    <h4 class="font-extrabold text-slate-800">
                        Informasi Akun
                    </h4>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Nama -->
                    <div>
                        <label class="block text-xs font-extrabold
                                      text-orange-700 uppercase
                                      tracking-wider mb-2">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ auth()->user()->name }}"
                            class="w-full px-4 py-3 rounded-xl
                                   border-2 border-orange-200
                                   bg-orange-50/50
                                   hover:border-orange-300
                                   focus:bg-white
                                   focus:border-[#FB8C00]
                                   focus:ring-4 focus:ring-orange-100
                                   outline-none transition-all
                                   text-sm font-semibold text-slate-800"
                            required>
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="block text-xs font-extrabold
                                      text-orange-700 uppercase
                                      tracking-wider mb-2">
                            Username / NIM
                        </label>

                        <input
                            type="text"
                            name="username"
                            value="{{ auth()->user()->username }}"
                            class="w-full px-4 py-3 rounded-xl
                                   border-2 border-orange-200
                                   bg-orange-50/50
                                   hover:border-orange-300
                                   focus:bg-white
                                   focus:border-[#FB8C00]
                                   focus:ring-4 focus:ring-orange-100
                                   outline-none transition-all
                                   text-sm font-semibold text-slate-800"
                            required>
                    </div>

                    <!-- Password -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-extrabold
                                      text-orange-700 uppercase
                                      tracking-wider mb-2">
                            Password Baru
                            <span class="text-slate-400 normal-case
                                         tracking-normal font-medium">
                                (Opsional)
                            </span>
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Kosongkan jika tidak ingin mengubah password"
                            class="w-full px-4 py-3 rounded-xl
                                   border-2 border-orange-200
                                   bg-orange-50/50
                                   hover:border-orange-300
                                   focus:bg-white
                                   focus:border-[#FB8C00]
                                   focus:ring-4 focus:ring-orange-100
                                   outline-none transition-all
                                   text-sm font-semibold text-slate-800">

                        <p class="text-[11px] text-slate-400 mt-2">
                            🔒 Gunakan password yang kuat untuk melindungi akun.
                        </p>
                    </div>
                </div>
            </section>

            <!-- TOMBOL AKSI -->
            <div class="flex flex-col-reverse sm:flex-row
                        justify-between items-stretch sm:items-center gap-3">

                <a href="{{ url('/dashboard') }}"
                   class="text-center px-5 py-3 rounded-xl
                          border-2 border-orange-200
                          bg-white hover:bg-orange-100
                          text-orange-700 text-sm font-bold
                          transition-colors">
                    ← Kembali ke Dashboard
                </a>

                <button
                    type="submit"
                    class="bg-gradient-to-r from-[#FB8C00] to-orange-600
                           hover:from-orange-600 hover:to-orange-700
                           text-white text-sm font-extrabold
                           px-7 py-3.5 rounded-xl
                           shadow-lg shadow-orange-500/25
                           hover:shadow-orange-500/40
                           hover:-translate-y-0.5
                           transition-all duration-200
                           flex items-center justify-center gap-2">

                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection