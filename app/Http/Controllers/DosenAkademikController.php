<?php

namespace App\Http\Controllers;

use App\Models\KelasDosen;
use App\Models\Krs;
use App\Models\MataKuliah;
use App\Models\Nilai;
use App\Models\Pengumuman;
use App\Models\Presensi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DosenAkademikController extends Controller
{
    public function jadwal()
    {
        $jadwal = KelasDosen::with('mataKuliah')
            ->where('dosen_id', auth()->id())->orderBy('hari')->orderBy('jam_mulai')->get();
        return view('dosen.jadwal', compact('jadwal'));
    }

    public function mahasiswaBimbingan(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $mahasiswaRole = Role::where('nama_role', 'Mahasiswa')->first();
        $mahasiswa = User::query()->where('role_id', $mahasiswaRole?->id)
            ->where('is_active', true)
            ->when($search, fn ($q) => $q->where(fn ($sub) => $sub->where('name', 'like', "%{$search}%")->orWhere('username', 'like', "%{$search}%")))
            ->orderBy('name')->paginate(12)->withQueryString();
        return view('dosen.mahasiswa-bimbingan', compact('mahasiswa', 'search'));
    }

    public function kalender()
    {
        $events = [
            ['tanggal' => '2026-10-19', 'judul' => 'Batas pengumpulan proyek UTS Internet Programming', 'jenis' => 'Akademik'],
            ['tanggal' => '2026-11-02', 'judul' => 'Minggu evaluasi tengah semester', 'jenis' => 'Perkuliahan'],
            ['tanggal' => '2026-12-21', 'judul' => 'Persiapan akhir semester', 'jenis' => 'Akademik'],
        ];
        return view('dosen.kalender', compact('events'));
    }

    public function profil()
    {
        return view('portal.profil', ['user' => auth()->user(), 'isDosen' => true]);
    }

    public function updateProfil(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:120']]);
        auth()->user()->update($data);
        return back()->with('success', 'Profil dosen berhasil diperbarui.');
    }

    public function pengaturan()
    {
        return view('portal.pengaturan');
    }

    public function mataKuliah(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $mataKuliah = MataKuliah::with('kelas')
            ->where('dosen_id', auth()->id())
            ->when($search, fn ($q) => $q->where(fn ($sub) => $sub->where('kode_mk', 'like', "%{$search}%")->orWhere('nama_mk', 'like', "%{$search}%")))
            ->orderBy('kode_mk')->paginate(10)->withQueryString();
        return view('dosen.mata-kuliah.index', compact('mataKuliah', 'search'));
    }

    public function createMataKuliah()
    {
        return view('dosen.mata-kuliah.form', ['mataKuliah' => new MataKuliah(), 'jadwal' => null, 'mode' => 'create']);
    }

    public function storeMataKuliah(Request $request)
    {
        $data = $this->validateMataKuliah($request);
        $jadwalData = $this->jadwalData($data);
        unset($data['hari'], $data['jam_mulai'], $data['jam_selesai'], $data['ruang']);
        $data['dosen_id'] = auth()->id();
        $mataKuliah = MataKuliah::create($data);
        if (collect($jadwalData)->filter(fn ($value) => $value !== null && $value !== '')->isNotEmpty()) {
            $mataKuliah->kelas()->create(array_merge($jadwalData, ['dosen_id' => auth()->id(), 'semester' => $mataKuliah->semester]));
        }
        return redirect('/dosen/mata-kuliah')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function editMataKuliah(MataKuliah $mataKuliah)
    {
        $this->authorizeOwnedCourse($mataKuliah);
        return view('dosen.mata-kuliah.form', ['mataKuliah' => $mataKuliah, 'jadwal' => $mataKuliah->kelas()->first(), 'mode' => 'edit']);
    }

    public function updateMataKuliah(Request $request, MataKuliah $mataKuliah)
    {
        $this->authorizeOwnedCourse($mataKuliah);
        $data = $this->validateMataKuliah($request, $mataKuliah->id);
        $jadwalData = $this->jadwalData($data);
        unset($data['hari'], $data['jam_mulai'], $data['jam_selesai'], $data['ruang']);
        $mataKuliah->update($data);
        $kelas = $mataKuliah->kelas()->first();
        if (collect($jadwalData)->filter(fn ($value) => $value !== null && $value !== '')->isNotEmpty()) {
            $mataKuliah->kelas()->updateOrCreate(['id' => $kelas?->id ?? 0], array_merge($jadwalData, ['dosen_id' => auth()->id(), 'semester' => $mataKuliah->semester]));
        } elseif ($kelas) {
            $kelas->delete();
        }
        return redirect('/dosen/mata-kuliah')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroyMataKuliah(MataKuliah $mataKuliah)
    {
        $this->authorizeOwnedCourse($mataKuliah);
        if ($mataKuliah->krs()->exists() || $mataKuliah->nilai()->exists()) {
            return back()->withErrors(['error' => 'Mata kuliah sudah dipakai di KRS/nilai sehingga tidak dapat dihapus.']);
        }
        $mataKuliah->kelas()->delete();
        $mataKuliah->delete();
        return redirect('/dosen/mata-kuliah')->with('success', 'Mata kuliah berhasil dihapus.');
    }

    private function validateMataKuliah(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'kode_mk' => ['required', 'string', 'max:20', Rule::unique('t033_mata_kuliahs', 'kode_mk')->ignore($id)],
            'nama_mk' => ['required', 'string', 'max:150'],
            'sks' => ['required', 'integer', 'between:1,6'],
            'semester' => ['required', 'string', 'max:40'],
            'deskripsi' => ['nullable', 'string', 'max:2000'],
            'hari' => ['nullable', Rule::in(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'])],
            'jam_mulai' => ['nullable', 'date_format:H:i'],
            'jam_selesai' => ['nullable', 'date_format:H:i', 'after:jam_mulai'],
            'ruang' => ['nullable', 'string', 'max:100'],
        ]);
    }

    private function jadwalData(array $data): array
    {
        return ['hari' => $data['hari'] ?? null, 'jam_mulai' => $data['jam_mulai'] ?? null, 'jam_selesai' => $data['jam_selesai'] ?? null, 'ruang' => $data['ruang'] ?? null];
    }

    private function authorizeOwnedCourse(MataKuliah $mataKuliah): void
    {
        abort_unless((int) $mataKuliah->dosen_id === (int) auth()->id(), 403, 'Akses ditolak. Mata kuliah ini bukan milik Anda.');
    }

    public function nilai(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $nilai = Nilai::with(['mahasiswa', 'mataKuliah'])
            ->where('dosen_id', auth()->id())
            ->when($search, fn ($q) => $q->where(function ($sub) use ($search) { $sub->whereHas('mahasiswa', fn ($m) => $m->where('name', 'like', "%{$search}%"))->orWhereHas('mataKuliah', fn ($mk) => $mk->where('nama_mk', 'like', "%{$search}%")); }))
            ->orderByDesc('updated_at')->paginate(12)->withQueryString();
        return view('dosen.nilai.index', compact('nilai', 'search'));
    }

    public function createNilai()
    {
        return view('dosen.nilai.form', ['nilai' => new Nilai(), 'mode' => 'create', 'mahasiswa' => $this->activeStudents(), 'mataKuliah' => $this->ownedCourses()]);
    }

    public function storeNilai(Request $request)
    {
        $data = $this->validateNilai($request);
        $this->ensureStudentAndCourse($data['mahasiswa_id'], $data['mata_kuliah_id']);
        $scores = $this->calculateGrade($data);
        Nilai::updateOrCreate(
            ['mahasiswa_id' => $data['mahasiswa_id'], 'mata_kuliah_id' => $data['mata_kuliah_id'], 'semester' => $data['semester']],
            array_merge($scores, ['dosen_id' => auth()->id()])
        );
        return redirect('/dosen/nilai')->with('success', 'Nilai berhasil disimpan.');
    }

    public function editNilai(Nilai $nilai)
    {
        abort_unless((int) $nilai->dosen_id === (int) auth()->id(), 403, 'Akses ditolak.');
        return view('dosen.nilai.form', ['nilai' => $nilai, 'mode' => 'edit', 'mahasiswa' => $this->activeStudents(), 'mataKuliah' => $this->ownedCourses()]);
    }

    public function updateNilai(Request $request, Nilai $nilai)
    {
        abort_unless((int) $nilai->dosen_id === (int) auth()->id(), 403, 'Akses ditolak.');
        $data = $this->validateNilai($request, true);
        $this->ensureStudentAndCourse($data['mahasiswa_id'], $data['mata_kuliah_id']);
        $scores = $this->calculateGrade($data);
        $nilai->update(array_merge($data, $scores, ['dosen_id' => auth()->id()]));
        return redirect('/dosen/nilai')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroyNilai(Nilai $nilai)
    {
        abort_unless((int) $nilai->dosen_id === (int) auth()->id(), 403, 'Akses ditolak.');
        $nilai->delete();
        return redirect('/dosen/nilai')->with('success', 'Data nilai berhasil dihapus.');
    }

    private function validateNilai(Request $request, bool $updating = false): array
    {
        return $request->validate([
            'mahasiswa_id' => ['required', 'integer', Rule::exists('t033_users', 'id')->where(fn ($q) => $q->where('role_id', Role::where('nama_role', 'Mahasiswa')->value('id')))],
            'mata_kuliah_id' => ['required', 'integer', Rule::exists('t033_mata_kuliahs', 'id')->where(fn ($q) => $q->where('dosen_id', auth()->id()))],
            'semester' => ['required', 'string', 'max:40'],
            'nilai_tugas' => ['required', 'numeric', 'between:0,100'],
            'nilai_uts' => ['required', 'numeric', 'between:0,100'],
            'nilai_uas' => ['required', 'numeric', 'between:0,100'],
        ]);
    }

    private function calculateGrade(array $data): array
    {
        $akhir = round(((float) $data['nilai_tugas'] * .20) + ((float) $data['nilai_uts'] * .30) + ((float) $data['nilai_uas'] * .50), 2);
        $huruf = match (true) { $akhir >= 85 => 'A', $akhir >= 80 => 'AB', $akhir >= 75 => 'B', $akhir >= 70 => 'BC', $akhir >= 60 => 'C', $akhir >= 50 => 'D', default => 'E' };
        return ['nilai_tugas' => $data['nilai_tugas'], 'nilai_uts' => $data['nilai_uts'], 'nilai_uas' => $data['nilai_uas'], 'nilai_akhir' => $akhir, 'nilai_huruf' => $huruf, 'status' => in_array($huruf, ['A', 'AB', 'B', 'BC', 'C'], true) ? 'Lulus' : 'Tidak Lulus'];
    }

    private function ensureStudentAndCourse(int|string $studentId, int|string $courseId): void
    {
        $isStudent = User::whereKey($studentId)->where('role_id', Role::where('nama_role', 'Mahasiswa')->value('id'))->exists();
        $ownsCourse = MataKuliah::whereKey($courseId)->where('dosen_id', auth()->id())->exists();
        abort_unless($isStudent && $ownsCourse, 403, 'Mahasiswa atau mata kuliah tidak valid untuk akun ini.');
    }

    private function activeStudents()
    {
        return User::where('role_id', Role::where('nama_role', 'Mahasiswa')->value('id'))->where('is_active', true)->orderBy('name')->get();
    }

    private function ownedCourses()
    {
        return MataKuliah::where('dosen_id', auth()->id())->orderBy('kode_mk')->get();
    }

    public function presensi(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $presensi = Presensi::with(['mahasiswa', 'mataKuliah'])
            ->where('dosen_id', auth()->id())
            ->when($search, fn ($q) => $q->where(function ($sub) use ($search) { $sub->whereHas('mahasiswa', fn ($m) => $m->where('name', 'like', "%{$search}%"))->orWhereHas('mataKuliah', fn ($mk) => $mk->where('nama_mk', 'like', "%{$search}%")); }))
            ->orderByDesc('tanggal')->paginate(12)->withQueryString();
        return view('dosen.presensi.index', compact('presensi', 'search'));
    }

    public function createPresensi()
    {
        return view('dosen.presensi.form', ['presensi' => new Presensi(), 'mode' => 'create', 'mahasiswa' => $this->activeStudents(), 'mataKuliah' => $this->ownedCourses()]);
    }

    public function storePresensi(Request $request)
    {
        $data = $this->validatePresensi($request);
        $this->ensureStudentAndCourse($data['mahasiswa_id'], $data['mata_kuliah_id']);
        Presensi::updateOrCreate(
            ['mahasiswa_id' => $data['mahasiswa_id'], 'mata_kuliah_id' => $data['mata_kuliah_id'], 'tanggal' => $data['tanggal']],
            array_merge($data, ['dosen_id' => auth()->id()])
        );
        return redirect('/dosen/presensi')->with('success', 'Presensi berhasil disimpan.');
    }

    public function editPresensi(Presensi $presensi)
    {
        abort_unless((int) $presensi->dosen_id === (int) auth()->id(), 403, 'Akses ditolak.');
        return view('dosen.presensi.form', ['presensi' => $presensi, 'mode' => 'edit', 'mahasiswa' => $this->activeStudents(), 'mataKuliah' => $this->ownedCourses()]);
    }

    public function updatePresensi(Request $request, Presensi $presensi)
    {
        abort_unless((int) $presensi->dosen_id === (int) auth()->id(), 403, 'Akses ditolak.');
        $data = $this->validatePresensi($request);
        $this->ensureStudentAndCourse($data['mahasiswa_id'], $data['mata_kuliah_id']);
        $presensi->update(array_merge($data, ['dosen_id' => auth()->id()]));
        return redirect('/dosen/presensi')->with('success', 'Presensi berhasil diperbarui.');
    }

    public function destroyPresensi(Presensi $presensi)
    {
        abort_unless((int) $presensi->dosen_id === (int) auth()->id(), 403, 'Akses ditolak.');
        $presensi->delete();
        return redirect('/dosen/presensi')->with('success', 'Data presensi berhasil dihapus.');
    }

    private function validatePresensi(Request $request): array
    {
        return $request->validate([
            'mahasiswa_id' => ['required', 'integer', Rule::exists('t033_users', 'id')->where(fn ($q) => $q->where('role_id', Role::where('nama_role', 'Mahasiswa')->value('id')))],
            'mata_kuliah_id' => ['required', 'integer', Rule::exists('t033_mata_kuliahs', 'id')->where(fn ($q) => $q->where('dosen_id', auth()->id()))],
            'tanggal' => ['required', 'date'],
            'status' => ['required', Rule::in(['Hadir', 'Izin', 'Sakit', 'Alpa'])],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ]);
    }

    public function pengumuman(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $pengumuman = Pengumuman::where('dosen_id', auth()->id())
            ->when($search, fn ($q) => $q->where('judul', 'like', "%{$search}%"))
            ->orderByDesc('published_at')->paginate(10)->withQueryString();
        return view('dosen.pengumuman.index', compact('pengumuman', 'search'));
    }

    public function createPengumuman()
    {
        return view('dosen.pengumuman.form', ['pengumuman' => new Pengumuman(), 'mode' => 'create']);
    }

    public function storePengumuman(Request $request)
    {
        $data = $this->validatePengumuman($request);
        $data['dosen_id'] = auth()->id();
        $data['published_at'] = $request->boolean('publish') ? now() : null;
        unset($data['publish']);
        Pengumuman::create($data);
        return redirect('/dosen/pengumuman')->with('success', 'Pengumuman berhasil disimpan.');
    }

    public function editPengumuman(Pengumuman $pengumuman)
    {
        abort_unless((int) $pengumuman->dosen_id === (int) auth()->id(), 403, 'Akses ditolak.');
        return view('dosen.pengumuman.form', ['pengumuman' => $pengumuman, 'mode' => 'edit']);
    }

    public function updatePengumuman(Request $request, Pengumuman $pengumuman)
    {
        abort_unless((int) $pengumuman->dosen_id === (int) auth()->id(), 403, 'Akses ditolak.');
        $data = $this->validatePengumuman($request);
        $data['published_at'] = $request->boolean('publish') ? ($pengumuman->published_at ?? now()) : null;
        unset($data['publish']);
        $pengumuman->update($data);
        return redirect('/dosen/pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroyPengumuman(Pengumuman $pengumuman)
    {
        abort_unless((int) $pengumuman->dosen_id === (int) auth()->id(), 403, 'Akses ditolak.');
        $pengumuman->delete();
        return redirect('/dosen/pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }

    private function validatePengumuman(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:180'],
            'isi' => ['required', 'string', 'max:20000'],
            'target_role' => ['required', Rule::in(['Semua', 'Mahasiswa', 'Dosen'])],
            'publish' => ['nullable', 'boolean'],
        ]);
    }
    
}
