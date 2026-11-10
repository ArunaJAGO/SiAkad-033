@extends('layouts.portal')
@section('pageTitle', 'Pengaturan Akun')
@section('content')
<section class="max-w-2xl bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
    <h3 class="text-lg font-extrabold">Ubah Password</h3><p class="text-sm text-slate-500 mt-1 mb-5">Gunakan password baru minimal 8 karakter. Password akan disimpan dalam bentuk hash.</p>
    <form action="{{ auth()->user()->role->nama_role === 'Dosen' ? route('dosen.pengaturan.password') : route('mahasiswa.pengaturan.password') }}" method="POST" class="space-y-4">@csrf
        <div><label class="block text-sm font-bold mb-1">Password saat ini</label><input type="password" name="password_lama" required autocomplete="current-password" class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
        <div><label class="block text-sm font-bold mb-1">Password baru</label><input type="password" name="password" required minlength="8" autocomplete="new-password" class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
        <div><label class="block text-sm font-bold mb-1">Konfirmasi password baru</label><input type="password" name="password_confirmation" required minlength="8" autocomplete="new-password" class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
        <button class="rounded-xl bg-[#FB8C00] hover:bg-orange-600 text-white px-5 py-3 font-bold">Perbarui Password</button>
    </form>
</section>
@endsection
