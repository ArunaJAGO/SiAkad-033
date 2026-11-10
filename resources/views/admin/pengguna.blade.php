@extends('layouts.portal')
@section('pageTitle', 'Kelola Pengguna')
@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-orange-200/80 overflow-hidden">
    <div class="px-6 py-4 border-b border-orange-100 bg-orange-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="font-extrabold text-slate-800">Daftar Pengguna Sistem</h3>
            <p class="text-xs text-slate-400">Kelola akun Mahasiswa, Dosen, dan Administrator.</p>
        </div>
        <div class="flex gap-2 w-full sm:w-auto">
            <input type="text" placeholder="Cari nama atau username..." class="px-4 py-2 text-sm border border-orange-200 rounded-xl focus:outline-none focus:border-[#FB8C00] w-full sm:w-64">
            <button class="bg-[#FB8C00] hover:bg-orange-600 text-white text-sm font-bold px-4 py-2 rounded-xl shadow-md transition-all whitespace-nowrap">+ Tambah</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-orange-50 text-slate-500 text-xs uppercase tracking-wider border-b border-orange-200">
                    <th class="p-4 font-bold">No</th>
                    <th class="p-4 font-bold">Pengguna</th>
                    <th class="p-4 font-bold">Role</th>
                    <th class="p-4 font-bold">Status</th>
                    <th class="p-4 font-bold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-slate-700 divide-y divide-orange-100">
                @foreach($users as $index => $user)
                <tr class="hover:bg-orange-50 transition-colors">
                    <td class="p-4">{{ $index + 1 }}</td>
                    <td class="p-4">
                        <p class="font-bold text-slate-800">{{ $user->name }}</p>
                        <p class="text-xs text-slate-500">{{ $user->username }}</p>
                    </td>
                    <td class="p-4">
                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-bold">
                            {{ $user->role_id == 1 ? 'Admin' : ($user->role_id == 2 ? 'Dosen' : 'Mahasiswa') }}
                        </span>
                    </td>
                    <td class="p-4">
                        <span class="{{ $user->is_active ? 'text-green-600' : 'text-red-500' }} font-bold text-xs">
                            {{ $user->is_active ? '● Aktif' : '● Nonaktif' }}
                        </span>
                    </td>
                    <td class="p-4 text-center space-x-2">
                        <button class="text-[#FB8C00] hover:text-orange-700 font-bold text-xs bg-orange-50 px-3 py-1.5 rounded-lg">Edit</button>
                        <button class="text-red-500 hover:text-red-700 font-bold text-xs bg-red-50 px-3 py-1.5 rounded-lg">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection