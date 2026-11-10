@extends('layouts.portal')
@section('pageTitle', $mode === 'edit' ? 'Edit Pengumuman' : 'Buat Pengumuman')
@section('content')
<section class="max-w-3xl bg-white rounded-2xl border border-slate-200 p-6 shadow-sm"><h3 class="text-lg font-extrabold">{{ $mode === 'edit' ? 'Edit Pengumuman' : 'Pengumuman Baru' }}</h3><form method="POST" action="{{ $mode === 'edit' ? route('dosen.pengumuman.update', $pengumuman) : route('dosen.pengumuman.store') }}" class="space-y-4 mt-5">@csrf @if($mode === 'edit') @method('PUT') @endif
<div><label class="block text-sm font-bold mb-1">Judul *</label><input name="judul" value="{{ old('judul',$pengumuman->judul) }}" maxlength="180" required class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
<div><label class="block text-sm font-bold mb-1">Isi pengumuman *</label><textarea name="isi" rows="7" required class="w-full rounded-xl border border-slate-300 px-4 py-3">{{ old('isi',$pengumuman->isi) }}</textarea></div>
<div><label class="block text-sm font-bold mb-1">Ditujukan kepada *</label><select name="target_role" required class="w-full rounded-xl border border-slate-300 px-4 py-3">@foreach(['Semua','Mahasiswa','Dosen'] as $target)<option value="{{ $target }}" @selected(old('target_role',$pengumuman->target_role ?? 'Semua')===$target)>{{ $target }}</option>@endforeach</select></div>
<label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200"><input type="checkbox" name="publish" value="1" class="w-4 h-4" @checked(old('publish', $pengumuman->published_at ? 1 : 0))><span><span class="block font-bold text-sm">Terbitkan sekarang</span><span class="block text-xs text-slate-500">Jika tidak dicentang, pengumuman disimpan sebagai draft.</span></span></label>
<div class="flex gap-3"><button class="bg-[#FB8C00] text-white px-5 py-3 rounded-xl font-bold">Simpan</button><a href="{{ route('dosen.pengumuman.index') }}" class="bg-slate-100 px-5 py-3 rounded-xl font-bold">Batal</a></div>
</form></section>
@endsection
