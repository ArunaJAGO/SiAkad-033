<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SiAkad Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen font-sans antialiased overflow-x-hidden">

    <!-- Container Utama Split Screen Full Edge-to-Edge -->
    <div class="min-h-screen w-full flex flex-col md:flex-row">
        
        <!-- Sisi Kiri (Oranye Full Screen Edge-to-Edge) -->
        <div class="md:w-1/2 bg-gradient-to-br from-[#FB8C00] to-orange-600 p-8 md:p-12 text-white flex flex-col justify-center items-center text-center min-h-[35vh] md:min-h-screen">
            <div class="text-6xl mb-4">🎓</div>
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">SiAkad Modern</h1>
            <p class="text-orange-100 text-sm md:text-base mt-3 font-medium leading-relaxed max-w-md">
                Sistem Informasi Akademik Terpadu<br>Fakultas Teknik Informatika
            </p>
        </div>

        <!-- Sisi Kanan (Form Input Full Height dengan Footer Melayang) -->
        <div class="md:w-1/2 bg-white p-8 md:p-16 flex flex-col justify-center relative min-h-[65vh] md:min-h-screen">
            
            <!-- Form Card / Wrapper (Di Tengah Layar Kanan) -->
            <div class="max-w-md w-full mx-auto my-auto py-6">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Selamat Datang! 👋</h2>
                <p class="text-gray-500 text-sm mt-1 mb-6">Silakan masuk ke akun Anda untuk melanjutkan.</p>

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs rounded-r-lg">
                        <p class="font-bold">Gagal Masuk</p>
                        <p>{{ $errors->first() }}</p>
                    </div>
                @endif

                <form action="/login" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Email Kampus</label>
                        <input type="text" name="username" value="{{ old('username') }}" required 
                               placeholder="25k10033@student.kampus"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#FB8C00] focus:bg-white transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Password</label>
                        <input type="password" name="password" required 
                               placeholder="••••••••"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#FB8C00] focus:bg-white transition-all">
                    </div>

                    <div class="flex items-center justify-between text-xs">
                        <label class="flex items-center text-gray-600 font-medium cursor-pointer">
                            <input type="checkbox" name="remember" class="rounded text-[#FB8C00] focus:ring-[#FB8C00] mr-2">
                            Ingat Saya
                        </label>
                        <a href="#" class="text-[#FB8C00] font-bold hover:underline">Lupa Password?</a>
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#FB8C00] hover:bg-orange-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-orange-500/30 transition-all text-sm mt-2">
                        Masuk ke Sistem
                    </button>
                </form>

                <p class="text-xs text-center text-gray-500 mt-6">
                    Belum punya akun? <a href="/register" class="text-[#FB8C00] font-bold hover:underline">Daftar Sekarang</a>
                </p>
            </div>

            <!-- Footer Melayang (Absolute) di Bagian Bawah Sisi Kanan -->
            <footer class="pt-6 pb-4 md:py-4 text-center w-full md:absolute md:bottom-4 md:left-0 md:right-0">
                <p class="text-xs font-semibold text-gray-500">
                    &copy; 2026 <span class="text-gray-800">Rafael Sentanu Aruna Septyandaru</span> – <span class="text-[#FB8C00]">25k10033</span>
                </p>
                <p class="text-[10px] text-gray-400 mt-0.5 font-medium">SiAkad Modern &bull; Fakultas Teknik Informatika</p>
            </footer>

        </div>

    </div>
    <script>
    // Bersihkan timer dan token lama begitu pengguna berada di halaman login
    document.addEventListener("DOMContentLoaded", function() {
        localStorage.removeItem('session_expire_time');
        localStorage.removeItem('api_token');
    });
</script>
</body>
</html>