<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $credentials['is_active'] = true;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $roleName = auth()->user()->role?->nama_role;
            if ($roleName === 'Admin') {
                return redirect()->intended('/admin/dashboard');
            }
            if ($roleName === 'Dosen') {
                return redirect()->intended('/dosen/dashboard');
            }
            if ($roleName === 'Mahasiswa') {
                return redirect()->intended('/dashboard');
            }

            Auth::logout();
            return redirect('/login')->withErrors(['username' => 'Role akun belum terdaftar. Hubungi Admin.']);
        }

        return back()->withErrors([
            'username' => 'Email Kampus atau Password salah.',
        ])->onlyInput('username');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}