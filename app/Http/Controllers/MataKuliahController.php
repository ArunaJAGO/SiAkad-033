<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah; // Pastikan Anda sudah membuat Model ini
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $matkul = MataKuliah::when($search, function ($query, $search) {
                return $query->where('nama_mk', 'like', "%{$search}%")
                             ->orWhere('kode_mk', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.matakuliah.index', compact('matkul', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliah',
            'nama_mk' => 'required',
            'sks' => 'required|integer'
        ]);

        MataKuliah::create($request->all());

        return redirect('/admin/matakuliah')->with('success', 'Mata kuliah ditambahkan');
    }

    public function destroy($id)
    {
        MataKuliah::destroy($id);
        return redirect('/admin/matakuliah')->with('success', 'Mata kuliah dihapus');
    }
}