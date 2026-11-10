<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        if (!$user->is_active) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->withErrors(['username' => 'Akun Anda sedang dinonaktifkan. Hubungi Admin.']);
        }

        $userRole = $user->role?->nama_role;
        if ($userRole && in_array($userRole, $roles, true)) {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk membuka halaman ini.');
    }
}
