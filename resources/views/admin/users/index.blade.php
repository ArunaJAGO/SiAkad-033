<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - SiAkad Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-800">

    <!-- Header / Banner Atas -->
    <div class="bg-gradient-to-r from-[#FB8C00] to-orange-500 pb-28 pt-8 px-4 sm:px-6 lg:px-8 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center text-white text-2xl font-extrabold tracking-wide">
                🎓 SiAkad <span class="ml-2 text-xs bg-black/20 px-2.5 py-1 rounded-md uppercase tracking-wider">Kelola Pengguna</span>
            </div>
            <a href="/admin/dashboard" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-xl text-sm font-bold backdrop-blur-sm transition-all">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-10 pb-12">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            
            <!-- Filter & Action Bar -->
            <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-gray-50/50">
                <!-- Form Pencarian -->
                <form action="/kelola-pengguna" method="GET" class="w-full md:w-96 flex gap-2">
                    <input type="text" name="search" value="{{ $search ?? '' }}" 
                           placeholder="Cari nama atau NIM/Username..." 
                           class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#FB8C00] text-sm">
                    <button type="submit" class="bg-[#FB8C00] text-white px-4 py-2 rounded-xl font-bold text-sm hover:bg-orange-600 transition-colors">
                        Cari
                    </button>
                </form>

                <!-- Tombol Tambah Pengguna -->
                <a href="/kelola-pengguna/tambah" class="w-full md:w-auto bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-md transition-colors flex items-center justify-center gap-2">
                    ➕ Tambah Pengguna Baru
                </a>
            </div>

            <!-- Pesan Sukses / Error -->
            @if(session('success'))
                <div class="mx-6 mt-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm rounded-r-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->has('error'))
                <div class="mx-6 mt-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <!-- Tabel Daftar Pengguna -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 text-xs uppercase font-bold">
                            <th class="px-6 py-4">Foto</th>
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Username / Email</th>
                            <th class="px-6 py-4">Role / Level</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium text-gray-700 divide-y divide-gray-50">
                        @forelse($users as $user)
                        <tr class="hover:bg-orange-50/40 transition-colors">
                            <td class="px-6 py-4">
                                <img src="{{ $user->foto_profil ? asset($user->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=FB8C00&color=fff' }}" 
                                     class="w-10 h-10 rounded-full object-cover border border-gray-200">
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-800">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $user->username }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full 
                                    {{ $user->role_id == 1 ? 'bg-orange-100 text-orange-700' : ($user->role_id == 2 ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                    {{ $user->role->nama_role ?? 'User' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($user->is_active)
                                    <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">Aktif</span>
                                @else
                                    <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="/kelola-pengguna/{{ $user->id }}/edit" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition-colors">
                                        ✏️ Edit
                                    </a>
                                    @if($user->is_active)
                                    <form action="/kelola-pengguna/{{ $user->id }}" method="POST" onsubmit="return confirm('Yakin ingin menonaktifkan pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition-colors">
                                            🚫 Nonaktifkan
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada data pengguna yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-6 border-t border-gray-100">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</body>
</html>