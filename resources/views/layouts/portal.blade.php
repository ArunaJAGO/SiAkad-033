<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle', 'Portal SiAkad') - Universitas Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #sidebar { transition: width 260ms ease; overflow-x: hidden; width: 16rem; }
        #sidebar.sidebar-collapsed { width: 5rem; }
        #sidebar.sidebar-collapsed .sidebar-label,
        #sidebar.sidebar-collapsed .sidebar-section-label,
        #sidebar.sidebar-collapsed .sidebar-user-details { display: none !important; }
        #sidebar.sidebar-collapsed .sidebar-brand { justify-content: center; padding: 0 0.5rem; gap: 0; }
        #sidebar.sidebar-collapsed .sidebar-nav, #sidebar.sidebar-collapsed .sidebar-user-panel,
        #sidebar.sidebar-collapsed .sidebar-link, #sidebar.sidebar-collapsed .sidebar-user-card { 
            justify-content: center; padding-left: 0.5rem; padding-right: 0.5rem; gap: 0; 
        }
        #sidebar.sidebar-collapsed #logoutButton { padding: 0.5rem; justify-content: center; gap: 0; }
        #sidebarToggle { flex-shrink: 0; }
        @media (prefers-reduced-motion: reduce) { #sidebar { transition: none; } }
    </style>
</head>
<body class="bg-orange-50/30 font-sans antialiased text-gray-800 flex min-h-screen">

    @php
        $nimRaw = strtoupper(explode('@', auth()->user()->username ?? '')[0]);
        $nimTampil = preg_match('/^(\d{2})([A-Z]\d)(\d{4})$/', $nimRaw, $nimParts)
            ? $nimParts[1] . '.' . $nimParts[2] . '.' . $nimParts[3] : $nimRaw;
        
        $role = auth()->user()->role_id ?? 3;
    @endphp

    <!-- SIDEBAR -->
    <aside id="sidebar" class="bg-[#1E293B] text-slate-300 flex flex-col justify-between flex-shrink-0 min-h-screen shadow-2xl z-40 hidden md:flex">
        <div>
            <!-- Brand / Logo -->
            <div class="sidebar-brand p-6 flex items-center gap-3 border-b border-slate-700/60">
                <div class="text-3xl flex-shrink-0" title="SiAkad">🎓</div>
                <div class="sidebar-label min-w-0">
                    <h1 class="font-extrabold text-xl text-white tracking-wide">SiAkad</h1>
                    <p class="text-[10px] text-[#FB8C00] font-bold tracking-wider uppercase">
                        {{ $role == 1 ? 'Portal Admin' : ($role == 2 ? 'Portal Dosen' : 'Portal Mahasiswa') }}
                    </p>
                </div>
            </div>

            <!-- Menu Navigasi Berdasarkan Role -->
            <nav class="sidebar-nav p-3 space-y-1.5">
                <p class="sidebar-section-label px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">
                    {{ $role == 1 ? 'Navigasi Admin' : 'Menu Utama' }}
                </p>

                @if($role == 1)
                    <!-- ================= MENU ADMIN ================= -->
                    <a href="{{ url('/admin/dashboard') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('admin/dashboard*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📊</span><span class="sidebar-label whitespace-nowrap">Dashboard</span>
                    </a>
                    <a href="{{ url('/admin/profil') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('admin/profil*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">👤</span><span class="sidebar-label whitespace-nowrap">Profil Admin</span>
                    </a>
                    <a href="{{ url('/admin/master-data') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('admin/master-data*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📚</span><span class="sidebar-label whitespace-nowrap">Master Data</span>
                    </a>
                    <a href="{{ url('/admin/pengguna') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('admin/pengguna*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">👥</span><span class="sidebar-label whitespace-nowrap">Kelola Pengguna</span>
                    </a>
                    <a href="{{ url('/admin/jadwal') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('admin/jadwal*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📅</span><span class="sidebar-label whitespace-nowrap">Jadwal Akademik</span>
                    </a>
                    <a href="{{ url('/admin/pengumuman') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('admin/pengumuman*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📢</span><span class="sidebar-label whitespace-nowrap">Pengumuman Global</span>
                    </a>
                    <a href="{{ url('/admin/laporan') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('admin/laporan*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">🖨️</span><span class="sidebar-label whitespace-nowrap">Laporan & Validasi</span>
                    </a>
                    <a href="{{ url('/admin/pengaturan') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('admin/pengaturan*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">⚙️</span><span class="sidebar-label whitespace-nowrap">Pengaturan Sistem</span>
                    </a>

                @elseif($role == 2)
                    <!-- ================= MENU DOSEN ================= -->
                    <a href="{{ url('/dosen/dashboard') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dosen/dashboard*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📊</span><span class="sidebar-label whitespace-nowrap">Dashboard</span>
                    </a>

                    <p class="sidebar-section-label px-3 pt-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Akademik</p>
                    <a href="{{ url('/dosen/jadwal') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dosen/jadwal*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📅</span><span class="sidebar-label whitespace-nowrap">Jadwal Mengajar</span>
                    </a>
                    <a href="{{ url('/dosen/mata-kuliah') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dosen/mata-kuliah*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📚</span><span class="sidebar-label whitespace-nowrap">Mata Kuliah</span>
                    </a>
                    <a href="{{ url('/dosen/mahasiswa-bimbingan') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dosen/mahasiswa-bimbingan*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">👥</span><span class="sidebar-label whitespace-nowrap">Mahasiswa Bimbingan</span>
                    </a>
                    <a href="{{ url('/dosen/nilai') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dosen/nilai*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📝</span><span class="sidebar-label whitespace-nowrap">Input Nilai</span>
                    </a>
                    <a href="{{ url('/dosen/presensi') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dosen/presensi*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">✅</span><span class="sidebar-label whitespace-nowrap">Presensi</span>
                    </a>

                    <p class="sidebar-section-label px-3 pt-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Informasi</p>
                    <a href="{{ url('/dosen/pengumuman') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dosen/pengumuman*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📢</span><span class="sidebar-label whitespace-nowrap">Pengumuman</span>
                    </a>
                    <a href="{{ url('/dosen/kalender') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dosen/kalender*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">🗓️</span><span class="sidebar-label whitespace-nowrap">Kalender Akademik</span>
                    </a>

                    <p class="sidebar-section-label px-3 pt-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Akun</p>
                    <a href="{{ url('/dosen/profil') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dosen/profil*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">👤</span><span class="sidebar-label whitespace-nowrap">Profil Dosen</span>
                    </a>
                    <a href="{{ url('/dosen/pengaturan') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dosen/pengaturan*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">⚙️</span><span class="sidebar-label whitespace-nowrap">Pengaturan</span>
                    </a>

                @else
                    <!-- ================= MENU MAHASISWA ================= -->
                    <a href="{{ url('/dashboard') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('dashboard*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📊</span><span class="sidebar-label whitespace-nowrap">Dashboard</span>
                    </a>
                    <a href="{{ url('/mahasiswa/profil') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('mahasiswa/profil*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">👤</span><span class="sidebar-label whitespace-nowrap">Profil Mahasiswa</span>
                    </a>
                    <a href="{{ url('/mahasiswa/krs') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('mahasiswa/krs*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📝</span><span class="sidebar-label whitespace-nowrap">KRS Online</span>
                    </a>
                    <a href="{{ url('/mahasiswa/khs') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('mahasiswa/khs*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📑</span><span class="sidebar-label whitespace-nowrap">KHS & Transkrip</span>
                    </a>
                    <a href="{{ url('/mahasiswa/presensi') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('mahasiswa/presensi*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📅</span><span class="sidebar-label whitespace-nowrap">Presensi Online</span>
                    </a>
                    <a href="{{ url('/mahasiswa/ektm') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('mahasiswa/ektm*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">💳</span><span class="sidebar-label whitespace-nowrap">E-KTM</span>
                    </a>
                    <a href="{{ url('/mahasiswa/pengumuman') }}" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ request()->is('mahasiswa/pengumuman*') ? 'bg-[#FB8C00] text-white font-bold shadow-lg shadow-orange-500/30' : 'hover:bg-slate-800 hover:text-white text-slate-400 font-medium' }}">
                        <span class="text-lg flex-shrink-0">📢</span><span class="sidebar-label whitespace-nowrap">Pengumuman</span>
                    </a>
                @endif
            </nav>
        </div>

        <!-- Profil Bawah & Logout -->
        <div class="sidebar-user-panel p-4 border-t border-slate-700/60 bg-slate-900/40">
            <div class="sidebar-user-card flex items-center gap-3 mb-3 p-2 rounded-xl bg-slate-800/80 border border-orange-500/20">
                <img src="{{ auth()->user()->foto_profil ? asset(auth()->user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=FB8C00&color=fff' }}"
                     alt="Foto profil" class="w-9 h-9 rounded-full object-cover border-2 border-[#FB8C00] flex-shrink-0">
                <div class="sidebar-user-details overflow-hidden min-w-0">
                    <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-[#FB8C00] font-mono font-bold">{{ $nimTampil }}</p>
                </div>
            </div>

            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" onclick="localStorage.removeItem('session_expire_time'); localStorage.removeItem('api_token');" title="Keluar Sistem" class="w-full bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white py-2 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2">
                    <span class="logout-icon">🚪</span><span class="sidebar-label">Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <div class="flex-1 flex flex-col min-h-screen min-w-0 overflow-y-auto">
        <header class="bg-white border-b border-orange-100 px-4 sm:px-6 py-4 flex justify-between items-center sticky top-0 z-30 shadow-sm">
            <div class="flex items-center gap-3 min-w-0">
                <button id="sidebarToggle" class="w-10 h-10 rounded-xl border border-orange-200 bg-orange-50/50 hover:bg-orange-100 text-[#FB8C00] flex items-center justify-center text-xl transition-colors">
                    ☰
                </button>
                <div class="min-w-0">
                    <h2 class="text-lg sm:text-xl font-extrabold text-slate-800">@yield('pageTitle', 'Dashboard')</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Fakultas Teknik Informatika &bull; Universitas Kampus</p>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                <span id="jam-realtime" role="timer" aria-live="off" class="font-mono text-[10px] sm:text-xs font-bold text-slate-600 whitespace-nowrap">⏳ Memuat sesi...</span>
                <span class="hidden sm:inline-flex bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full items-center gap-1.5 border border-green-200 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Sistem Aktif
                </span>
            </div>
        </header>

        <main class="p-4 sm:p-6 flex-1">
            @yield('content')
        </main>

        <footer class="bg-white border-t border-orange-100 py-4 px-4 sm:px-6 mt-auto z-10 relative">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <p class="text-xs font-semibold text-slate-600">
                        &copy; 2026 <span class="text-slate-800">Rafael Sentanu Aruna S</span> – <span class="text-[#FB8C00] font-mono font-bold">25.K1.0033</span>
                    </p>
                </div>
                <span class="text-[11px] text-slate-400 font-medium">SiAkad Modern &bull; Sistem Informasi Akademik</span>
            </div>
        </footer>
    </div>

    <!-- Script Sidebar & Timer Universal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebarToggle');
            const sidebarStorageKey = 'siakad-sidebar-collapsed';

            function setSidebarCollapsed(collapsed) {
                sidebar.classList.toggle('sidebar-collapsed', collapsed);
                try { localStorage.setItem(sidebarStorageKey, collapsed ? '1' : '0'); } catch(e){}
            }

            let initiallyCollapsed = false;
            try { initiallyCollapsed = localStorage.getItem(sidebarStorageKey) === '1'; } catch(e){}
            setSidebarCollapsed(initiallyCollapsed);

            toggleButton.addEventListener('click', () => setSidebarCollapsed(!sidebar.classList.contains('sidebar-collapsed')));

            // ================= PENGHITUNG WAKTU SESI UNIVERSAL =================
            const display = document.getElementById('jam-realtime');
            const timerElement = document.getElementById('sisaWaktu');
            const progressElement = document.getElementById('progressWaktu');
            const adminTimer = document.getElementById('adminSisaSesi');
            const logoutForm = document.getElementById('logoutForm');

            const sessionKey = 'session_expire_time';
            const durationMs = 120 * 60 * 1000; // 2 jam (120 menit)
            let expireTime = Number(localStorage.getItem(sessionKey));
            let logoutStarted = false;

            // Inisialisasi batas waktu jika belum ada (tidak ter-reset saat refresh)
            if (!Number.isFinite(expireTime) || expireTime <= 0) {
                expireTime = Date.now() + durationMs;
                localStorage.setItem(sessionKey, String(expireTime));
            }

            function handleExpiredSession() {
                if (logoutStarted) return;
                logoutStarted = true;

                if (display) {
                    display.textContent = '⏳ Sesi habis';
                    display.classList.remove('text-slate-600');
                    display.classList.add('text-red-600');
                }
                if (timerElement) {
                    timerElement.textContent = 'Waktu habis';
                }
                if (progressElement) {
                    progressElement.style.width = '0%';
                    progressElement.classList.replace('bg-[#FB8C00]', 'bg-red-500');
                }
                if (adminTimer) {
                    adminTimer.textContent = 'Sesi habis';
                    adminTimer.classList.add('text-red-600');
                }

                localStorage.removeItem(sessionKey);
                localStorage.removeItem('api_token');

                if (logoutForm) {
                    if (typeof logoutForm.requestSubmit === 'function') {
                        logoutForm.requestSubmit();
                    } else {
                        logoutForm.submit();
                    }
                } else {
                    window.location.replace('/login');
                }
            }

            function updateTimer() {
                const storedExpiry = Number(localStorage.getItem(sessionKey));
                if (Number.isFinite(storedExpiry) && storedExpiry > 0) {
                    expireTime = storedExpiry;
                }
                const remaining = expireTime - Date.now();
                if (remaining <= 0) {
                    handleExpiredSession();
                    return;
                }

                const totalSeconds = Math.floor(remaining / 1000);
                const hours = Math.floor(totalSeconds / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;

                const timeString = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

                if (display) {
                    display.textContent = `⏳ Sisa Sesi: ${timeString}`;
                }

                if (adminTimer) {
                    adminTimer.textContent = timeString;
                }

                if (timerElement) {
                    timerElement.textContent = `${String(hours).padStart(2, '0')} jam ${String(minutes).padStart(2, '0')} menit ${String(seconds).padStart(2, '0')} detik`;
                }

                if (progressElement) {
                    const pct = Math.max(0, Math.min(100, (remaining / durationMs) * 100));
                    progressElement.style.width = pct + '%';
                }
            }

            updateTimer();
            window.setInterval(updateTimer, 1000);
        });
    </script>
</body>
</html>