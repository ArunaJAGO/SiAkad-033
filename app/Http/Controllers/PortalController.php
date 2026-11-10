<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\MataKuliah;
use App\Models\Nilai;
use App\Models\Pengumuman;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PortalController extends Controller
{
    public function profil()
    {
        return view('portal.profil', ['user' => auth()->user()]);
    }

    public function updateProfil(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:120']]);
        auth()->user()->update($data);
        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function krs(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $mataKuliah = MataKuliah::with('dosen')
            ->whereNotNull('nama_mk')
            ->when($search, fn ($query) => $query->where(function ($q) use ($search) {
                $q->where('nama_mk', 'like', "%{$search}%")
                    ->orWhere('kode_mk', 'like', "%{$search}%");
            }))
            ->orderBy('semester')
            ->orderBy('kode_mk')
            ->paginate(15)
            ->withQueryString();

        $krsSaya = Krs::with('mataKuliah')
            ->where('mahasiswa_id', auth()->id())
            ->where('semester', 'Ganjil 2026')
            ->orderByDesc('created_at')->get();

        $terdaftar = $krsSaya->pluck('mata_kuliah_id')->all();
        return view('portal.krs', compact('mataKuliah', 'krsSaya', 'terdaftar', 'search'));
    }

    public function storeKrs(Request $request)
    {
        $data = $request->validate(['mata_kuliah_id' => ['required', 'integer', 'exists:t033_mata_kuliahs,id']]);
        $already = Krs::where('mahasiswa_id', auth()->id())
            ->where('mata_kuliah_id', $data['mata_kuliah_id'])
            ->where('semester', 'Ganjil 2026')->exists();

        if ($already) {
            return back()->withErrors(['mata_kuliah_id' => 'Mata kuliah tersebut sudah ada di KRS kamu.']);
        }

        Krs::create([
            'mahasiswa_id' => auth()->id(),
            'mata_kuliah_id' => $data['mata_kuliah_id'],
            'semester' => 'Ganjil 2026',
            'status' => 'Diajukan',
        ]);

        return back()->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    public function destroyKrs(Krs $krs)
    {
        abort_unless($krs->mahasiswa_id === auth()->id(), 403, 'Akses ditolak.');
        abort_unless($krs->status === 'Diajukan', 403, 'KRS yang sudah diproses tidak dapat dibatalkan dari halaman ini.');
        $krs->delete();
        return back()->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }

    public function khs()
    {
        $nilai = Nilai::with('mataKuliah', 'dosen')
            ->where('mahasiswa_id', auth()->id())
            ->orderBy('semester')->get();

        $totalSks = $nilai->filter(fn ($n) => $n->mataKuliah && !in_array($n->nilai_huruf, ['D', 'E', null], true))
            ->sum(fn ($n) => $n->mataKuliah->sks ?? 0);
        $bobot = ['A' => 4.0, 'AB' => 3.5, 'B' => 3.0, 'BC' => 2.5, 'C' => 2.0, 'D' => 1.0, 'E' => 0.0];
        $sksNilai = $nilai->filter(fn ($n) => $n->mataKuliah && $n->nilai_huruf !== null);
        $pembagi = $sksNilai->sum(fn ($n) => $n->mataKuliah->sks ?? 0);
        $ipk = $pembagi > 0 ? $sksNilai->sum(fn ($n) => ($bobot[$n->nilai_huruf] ?? 0) * ($n->mataKuliah->sks ?? 0)) / $pembagi : null;

        return view('portal.khs', compact('nilai', 'totalSks', 'ipk'));
    }

    public function presensi()
    {
        $presensi = Presensi::with('mataKuliah', 'dosen')
            ->where('mahasiswa_id', auth()->id())->orderByDesc('tanggal')->paginate(12);
        return view('portal.presensi', compact('presensi'));
    }

    public function ektm()
    {
        return view('portal.ektm', ['user' => auth()->user()]);
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::with('dosen')
            ->whereNotNull('published_at')->where('published_at', '<=', now())
            ->whereIn('target_role', ['Semua', 'Mahasiswa'])
            ->orderByDesc('published_at')->paginate(10);
        return view('portal.pengumuman', compact('pengumuman'));
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'password_lama' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();
        if (!Hash::check($data['password_lama'], $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak cocok.']);
        }
        $user->password = $data['password'];
        $user->save();
        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
