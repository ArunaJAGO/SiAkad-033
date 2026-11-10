<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Menampilkan halaman view profil admin
    public function profil()
    {
        return view('admin.profil');
    }

    // Memproses penyimpanan perubahan profil
    public function updateProfil(Request $request)
    {
        $user = auth()->user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;

        // Jika kolom password diisi, ubah sandinya
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Jika admin mengunggah foto baru
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($user->foto_profil && file_exists(public_path($user->foto_profil))) {
                unlink(public_path($user->foto_profil));
            }

            // Simpan foto baru ke public/uploads/profil
            $file = $request->file('foto_profil');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            
            // Pastikan folder tujuan ada
            $tujuanFolder = public_path('uploads/profil');
            if (!file_exists($tujuanFolder)) {
                mkdir($tujuanFolder, 0755, true);
            }

            $file->move($tujuanFolder, $namaFile);
            $user->foto_profil = 'uploads/profil/' . $namaFile;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil admin berhasil diperbarui!');
    }
    public function pengguna()
    {
        // Mengambil semua data pengguna dari database
        $users = \App\Models\User::all(); 
        
        // Melempar variabel $users ke halaman Blade
        return view('admin.pengguna', compact('users'));
    }
}