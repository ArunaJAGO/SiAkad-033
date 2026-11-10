<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KelolaAkunController extends Controller
{
    public function mahasiswaIndex(Request $request) { return $this->indexRole($request, 'Mahasiswa', 'mahasiswa'); }
    public function dosenIndex(Request $request) { return $this->indexRole($request, 'Dosen', 'dosen'); }
    public function mahasiswaCreate() { return $this->createRole('Mahasiswa', 'mahasiswa'); }
    public function dosenCreate() { return $this->createRole('Dosen', 'dosen'); }
    public function mahasiswaStore(Request $request) { return $this->storeRole($request, 'Mahasiswa', 'mahasiswa'); }
    public function dosenStore(Request $request) { return $this->storeRole($request, 'Dosen', 'dosen'); }
    public function mahasiswaEdit(User $user) { return $this->editRole($user, 'Mahasiswa', 'mahasiswa'); }
    public function dosenEdit(User $user) { return $this->editRole($user, 'Dosen', 'dosen'); }
    public function mahasiswaUpdate(Request $request, User $user) { return $this->updateRole($request, $user, 'Mahasiswa', 'mahasiswa'); }
    public function dosenUpdate(Request $request, User $user) { return $this->updateRole($request, $user, 'Dosen', 'dosen'); }
    public function mahasiswaDestroy(User $user) { return $this->deactivateRole($user, 'Mahasiswa', 'mahasiswa'); }
    public function dosenDestroy(User $user) { return $this->deactivateRole($user, 'Dosen', 'dosen'); }

    private function indexRole(Request $request, string $roleName, string $slug)
    {
        $search = trim((string) $request->query('search', ''));
        $roleId = Role::where('nama_role', $roleName)->value('id');
        $users = User::with('role')->where('role_id', $roleId)
            ->when($search, fn ($q) => $q->where(fn ($sub) => $sub->where('name', 'like', "%{$search}%")->orWhere('username', 'like', "%{$search}%")))
            ->orderBy('name')->paginate(10)->withQueryString();
        return view('admin.akun.index', compact('users', 'search', 'roleName', 'slug'));
    }

    private function createRole(string $roleName, string $slug)
    {
        return view('admin.akun.form', ['user' => new User(), 'roleName' => $roleName, 'slug' => $slug, 'mode' => 'create']);
    }

    private function storeRole(Request $request, string $roleName, string $slug)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'string', 'max:120', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data['role_id'] = Role::where('nama_role', $roleName)->value('id');
        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = true;
        User::create($data);
        return redirect("/admin/{$slug}")->with('success', "Akun {$roleName} berhasil ditambahkan.");
    }

    private function editRole(User $user, string $roleName, string $slug)
    {
        abort_unless($user->role?->nama_role === $roleName, 404);
        return view('admin.akun.form', compact('user', 'roleName', 'slug') + ['mode' => 'edit']);
    }

    private function updateRole(Request $request, User $user, string $roleName, string $slug)
    {
        abort_unless($user->role?->nama_role === $roleName, 404);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'string', 'max:120', Rule::unique('users', 'username')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return redirect("/admin/{$slug}")->with('success', "Data {$roleName} berhasil diperbarui.");
    }

    private function deactivateRole(User $user, string $roleName, string $slug)
    {
        abort_unless($user->role?->nama_role === $roleName, 404);
        $user->is_active = false;
        $user->save();
        return redirect("/admin/{$slug}")->with('success', "Akun {$roleName} berhasil dinonaktifkan.");
    }
}
