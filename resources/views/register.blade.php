<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SiAkad Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex min-h-screen font-sans flex-col-reverse md:flex-row">

    <!-- Sisi Kiri: Form Registrasi -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-8 sm:p-12 bg-white">
        <div class="w-full max-w-md">
            
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun Baru ✨</h2>
                <p class="text-gray-500">Bergabunglah dengan portal SiAkad Modern sekarang.</p>
            </div>

            <form action="#" method="POST" class="space-y-5">
                @csrf
                
                <!-- Input Nama -->
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">👤</div>
                        <input type="text" id="name" name="name" class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-100 border-transparent focus:border-[#FB8C00] focus:bg-white focus:ring-2 focus:ring-[#FB8C00] focus:ring-opacity-50 transition-all duration-300 outline-none shadow-sm" placeholder="Sesuai KTP / KTM" required>
                    </div>
                </div>

                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Kampus</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">✉️</div>
                        <input type="email" id="email" name="email" class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-100 border-transparent focus:border-[#FB8C00] focus:bg-white focus:ring-2 focus:ring-[#FB8C00] focus:ring-opacity-50 transition-all duration-300 outline-none shadow-sm" placeholder="nim@student.kampus.ac.id" required>
                    </div>
                </div>

                <!-- Input Role (Dropdown) -->
                <div>
                    <label for="role_id" class="block text-sm font-bold text-gray-700 mb-2">Daftar Sebagai (Role)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">🎭</div>
                        <select id="role_id" name="role_id" class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-100 border-transparent focus:border-[#FB8C00] focus:bg-white focus:ring-2 focus:ring-[#FB8C00] focus:ring-opacity-50 transition-all duration-300 outline-none shadow-sm appearance-none" required>
                            <option value="" disabled selected>-- Pilih Peran Anda --</option>
                            <option value="3">Mahasiswa (Pengguna Umum)</option>
                            <option value="2">Dosen (Tenaga Pengajar)</option>
                            <option value="1">Admin (Bagian Akademik)</option>
                        </select>
                        <!-- Panah Dropdown Custom -->
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">🔒</div>
                        <input type="password" id="password" name="password" class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-100 border-transparent focus:border-[#FB8C00] focus:bg-white focus:ring-2 focus:ring-[#FB8C00] focus:ring-opacity-50 transition-all duration-300 outline-none shadow-sm" placeholder="••••••••" required>
                    </div>
                </div>

                <!-- Tombol Register -->
                <button type="submit" class="w-full py-3.5 mt-2 bg-[#FB8C00] hover:bg-orange-600 text-white font-bold rounded-xl shadow-lg hover:shadow-orange-500/30 transform hover:-translate-y-0.5 transition-all duration-200">
                    Daftar Sekarang
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-gray-600">
                Sudah punya akun? 
                <a href="/login" class="font-bold text-[#FB8C00] hover:text-orange-700 transition-colors underline decoration-2 underline-offset-4">Masuk di sini</a>
            </p>
        </div>
    </div>

    <!-- Sisi Kanan: Visual & Branding (Disembunyikan di layar HP) -->
    <div class="hidden md:flex md:w-1/2 bg-gradient-to-bl from-[#FB8C00] to-orange-600 relative overflow-hidden justify-center items-center">
        <!-- Ornamen -->
        <div class="absolute bottom-[-10%] left-[-10%] w-80 h-80 bg-white opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute top-[10%] right-[10%] w-48 h-48 bg-white opacity-20 rounded-full blur-2xl animate-pulse"></div>
        
        <div class="z-10 text-center px-8">
            <div class="text-7xl mb-6 drop-shadow-lg">🚀</div>
            <h1 class="text-4xl font-extrabold text-white mb-4 tracking-wide drop-shadow-md">Mulai Perjalananmu</h1>
            <p class="text-orange-100 text-lg font-medium">Akses semua fitur akademik<br>dalam satu genggaman.</p>
        </div>
    </div>
    <!-- Footer Transparan Melayang (Sesuai Pedoman) -->
    <footer class="py-6 text-center w-full relative z-10">
        <div class="flex flex-col items-center justify-center gap-1">
            <p class="text-xs font-semibold text-gray-500">
                &copy; 2026 <span class="text-gray-700">Rafael Sentanu Aruna Septyandaru</span> – <span class="text-[#FB8C00] font-mono font-bold">25.K1.0033</span>
            </p>
            <p class="text-[10px] text-gray-400 mt-0.5 font-medium">SiAkad Modern &bull; Fakultas Teknik Informatika</p>
        </div>
    </footer>
    </div>
</body>
</body>
</html>