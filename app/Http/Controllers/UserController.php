<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));
        $users = User::with('role')
            ->when($search, fn ($query) => $query->where(fn ($sub) => $sub
                ->where('name', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%")))
            ->orderBy('name')->paginate(10)->withQueryString();
        return view('admin.users.index', compact('users', 'search'));
    }

    public function create()
    {
        $roles = Role::orderBy('id')->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
            'name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'string', 'max:120', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = true;
        User::create($data);
        return redirect('/kelola-pengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('id')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
            'name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'string', 'max:120', 'unique:users,username,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $data['is_active'] = $request->boolean('is_active');
        $user->update($data);
        return redirect('/kelola-pengguna')->with('success', 'Data pengguna berhasil diubah.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Anda tidak bisa menonaktifkan akun sendiri.']);
        }
        $user->update(['is_active' => false]);
        return redirect('/kelola-pengguna')->with('success', 'Pengguna berhasil dinonaktifkan.');
    }

    // --- FUNGSI BARU UNTUK UPLOAD FOTO (Yang tadi dicari oleh sistem) ---
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            
            // Buat nama file unik (Ambil NIM dari email kampus. Misal: 25k10033)
            $nim = preg_replace('/[^A-Za-z0-9_-]/', '', explode('@', auth()->user()->username)[0]);
            $namaFile = $nim . '.' . $file->getClientOriginalExtension();
            
            // Pindahkan file ke folder public/uploads/profil
            $file->move(public_path('uploads/profil'), $namaFile);
            
            // Update path di database
            $user = User::find(auth()->id());
            $user->foto_profil = 'uploads/profil/' . $namaFile;
            $user->save();

            return back()->with('success', 'Foto profil berhasil diperbarui!');
        }

        return back()->withErrors(['foto' => 'Gagal mengupload foto.']);
    }

    // --- FUNGSI BARU UNTUK MENGHAPUS FOTO ---
    public function hapusFoto()
    {
        $user = User::find(auth()->id());

        // Pastikan kolom foto tidak kosong
        if ($user->foto_profil) {
            // Hapus file fisik dari folder public/uploads/profil/
            $pathFisik = public_path($user->foto_profil);
            if (file_exists($pathFisik)) {
                unlink($pathFisik); // Perintah PHP untuk menghapus file
            }

            // Kosongkan nama file di database
            $user->foto_profil = null;
            $user->save();

            return back()->with('success', 'Foto profil berhasil dihapus!');
        }

        return back()->withErrors(['foto' => 'Tidak ada foto untuk dihapus.']);
    }
}