@extends('layouts.portal')
@section('pageTitle', 'Kelola Pengguna')
@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="font-extrabold text-slate-800">Daftar Pengguna Sistem</h3>
            <p class="text-xs text-slate-400">Kelola akun Mahasiswa, Dosen, dan Administrator.</p>
        </div>
        <div class="flex gap-2 w-full sm:w-auto">
            <input type="text" placeholder="Cari nama atau username..." class="px-4 py-2 text-sm border border-slate-200 rounded-xl focus:outline-none focus:border-[#FB8C00] w-full sm:w-64">
            <button class="bg-[#FB8C00] hover:bg-orange-600 text-white text-sm font-bold px-4 py-2 rounded-xl shadow-md transition-all whitespace-nowrap">+ Tambah</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                    <th class="p-4 font-bold">No</th>
                    <th class="p-4 font-bold">Pengguna</th>
                    <th class="p-4 font-bold">Role</th>
                    <th class="p-4 font-bold">Status</th>
                    <th class="p-4 font-bold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-slate-700 divide-y divide-slate-100">
                <!-- Contoh Data Statis (Nanti diganti perulangan dari database) -->
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="p-4">1</td>
                    <td class="p-4">
                        <p class="font-bold text-slate-800">Budi Santoso</p>
                        <p class="text-xs text-slate-500">25K10001@student.kampus</p>
                    </td>
                    <td class="p-4"><span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">Mahasiswa</span></td>
                    <td class="p-4"><span class="text-green-600 font-bold text-xs">● Aktif</span></td>
                    <td class="p-4 text-center space-x-2">
                        <button class="text-[#FB8C00] hover:text-orange-700 font-bold text-xs bg-orange-50 px-3 py-1.5 rounded-lg">Edit</button>
                        <button class="text-red-500 hover:text-red-700 font-bold text-xs bg-red-50 px-3 py-1.5 rounded-lg">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection