<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaAkunApiController extends Controller
{
    // Melihat profil sendiri
    public function index(Request $request) {
        return response()->json(['status' => 'success', 'data' => $request->user()], 200);
    }

    // Mengubah password atau nama sendiri
    public function update(Request $request) {
        $user = $request->user();
        
        $data = $request->only(['name', 'password']);
        
        // Jika user mengubah password, enkripsi password barunya
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'status' => 'success', 
            'message' => 'Akun berhasil diperbarui', 
            'data' => $user
        ], 200);
    }
}