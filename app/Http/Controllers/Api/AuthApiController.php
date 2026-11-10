<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthApiController extends Controller
{
    // Fungsi Login API
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        // Cek apakah user ada dan password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => 'error', 'message' => 'Email Kampus atau Password salah'], 401);
        }

        // Buat Token API (Sanctum)
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'       => 'success',
            'message'      => 'Login Berhasil',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'data_user'    => $user
        ], 200);
    }

    // Fungsi Logout API
    public function logout(Request $request)
    {
        // Hapus token yang sedang dipakai
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Logout Berhasil, Token dihapus'
        ], 200);
    }
}