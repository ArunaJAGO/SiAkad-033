@extends('layouts.portal')
@section('pageTitle', $mode === 'edit' ? 'Edit Mata Kuliah' : 'Tambah Mata Kuliah')
@section('content')
<section class="max-w-3xl bg-white rounded-2xl border border-slate-200 p-6 shadow-sm"><h3 class="text-lg font-extrabold">{{ $mode === 'edit' ? 'Perbarui Data Mata Kuliah' : 'Form Mata Kuliah Baru' }}</h3><p class="text-sm text-slate-500 mt-1 mb-5">Jadwal pengajaran bersifat opsional dan dapat dilengkapi nanti.</p>
<form method="POST" action="{{ $mode === 'edit' ? route('dosen.mata-kuliah.update', $mataKuliah) : route('dosen.mata-kuliah.store') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">@csrf @if($mode === 'edit') @method('PUT') @endif
<div><label class="block text-sm font-bold mb-1">Kode Mata Kuliah *</label><input name="kode_mk" value="{{ old('kode_mk', $mataKuliah->kode_mk) }}" required maxlength="20" class="w-full border border-slate-300 rounded-xl px-4 py-3"></div>
<div><label class="block text-sm font-bold mb-1">Nama Mata Kuliah *</label><input name="nama_mk" value="{{ old('nama_mk', $mataKuliah->nama_mk) }}" required maxlength="150" class="w-full border border-slate-300 rounded-xl px-4 py-3"></div>
<div><label class="block text-sm font-bold mb-1">Jumlah SKS *</label><input type="number" name="sks" min="1" max="6" value="{{ old('sks', $mataKuliah->sks ?? 3) }}" required class="w-full border border-slate-300 rounded-xl px-4 py-3"></div>
<div><label class="block text-sm font-bold mb-1">Semester *</label><input name="semester" value="{{ old('semester', $mataKuliah->semester ?? 'Ganjil 2026') }}" required maxlength="40" class="w-full border border-slate-300 rounded-xl px-4 py-3"></div>
<div class="sm:col-span-2"><label class="block text-sm font-bold mb-1">Deskripsi</label><textarea name="deskripsi" rows="3" class="w-full border border-slate-300 rounded-xl px-4 py-3">{{ old('deskripsi', $mataKuliah->deskripsi) }}</textarea></div>
<div class="sm:col-span-2 border-t border-slate-100 pt-4"><p class="font-extrabold mb-3">Jadwal (opsional)</p></div>
<div><label class="block text-sm font-bold mb-1">Hari</label><select name="hari" class="w-full border border-slate-300 rounded-xl px-4 py-3"><option value="">Belum ditentukan</option>@foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)<option value="{{ $hari }}" @selected(old('hari', $jadwal->hari ?? '') === $hari)>{{ $hari }}</option>@endforeach</select></div>
<div><label class="block text-sm font-bold mb-1">Ruang</label><input name="ruang" value="{{ old('ruang', $jadwal->ruang ?? '') }}" class="w-full border border-slate-300 rounded-xl px-4 py-3"></div>
<div><label class="block text-sm font-bold mb-1">Jam Mulai</label><input type="time" name="jam_mulai" value="{{ old('jam_mulai', isset($jadwal->jam_mulai) ? substr($jadwal->jam_mulai,0,5) : '') }}" class="w-full border border-slate-300 rounded-xl px-4 py-3"></div>
<div><label class="block text-sm font-bold mb-1">Jam Selesai</label><input type="time" name="jam_selesai" value="{{ old('jam_selesai', isset($jadwal->jam_selesai) ? substr($jadwal->jam_selesai,0,5) : '') }}" class="w-full border border-slate-300 rounded-xl px-4 py-3"></div>
<div class="sm:col-span-2 flex flex-wrap gap-3 pt-2"><button class="bg-[#FB8C00] hover:bg-orange-600 text-white px-5 py-3 rounded-xl font-bold">Simpan</button><a href="{{ route('dosen.mata-kuliah.index') }}" class="bg-slate-100 text-slate-700 px-5 py-3 rounded-xl font-bold">Batal</a></div>
</form></section>
@endsection
