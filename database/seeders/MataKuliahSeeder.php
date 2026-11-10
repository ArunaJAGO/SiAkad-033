<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataKuliah = [
            // Semester 1
            ['kode_mk' => 'TIF101', 'nama_mk' => 'Algoritma dan Pemrograman Dasar', 'sks' => 3, 'semester' => 1],
            ['kode_mk' => 'TIF102', 'nama_mk' => 'Pengantar Teknologi Informasi', 'sks' => 2, 'semester' => 1],
            ['kode_mk' => 'TIF103', 'nama_mk' => 'Kalkulus Informatika', 'sks' => 3, 'semester' => 1],
            
            // Semester 2
            ['kode_mk' => 'TIF201', 'nama_mk' => 'Pemrograman Berorientasi Objek (Java)', 'sks' => 3, 'semester' => 2],
            ['kode_mk' => 'TIF202', 'nama_mk' => 'Sistem Basis Data (SQL)', 'sks' => 3, 'semester' => 2],
            ['kode_mk' => 'TIF203', 'nama_mk' => 'Aljabar Linear dan Matriks', 'sks' => 3, 'semester' => 2],
            
            // Semester 3
            ['kode_mk' => 'TIF301', 'nama_mk' => 'Struktur Data', 'sks' => 3, 'semester' => 3],
            ['kode_mk' => 'TIF302', 'nama_mk' => 'Pemrograman Web (PHP & Laravel)', 'sks' => 3, 'semester' => 3],
            ['kode_mk' => 'TIF303', 'nama_mk' => 'Sistem Operasi (Linux)', 'sks' => 3, 'semester' => 3],
            
            // Semester 4
            ['kode_mk' => 'TIF401', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 4],
            ['kode_mk' => 'TIF402', 'nama_mk' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 4],
            ['kode_mk' => 'TIF403', 'nama_mk' => 'Interaksi Manusia dan Komputer', 'sks' => 3, 'semester' => 4],
            
            // Semester 5
            ['kode_mk' => 'TIF501', 'nama_mk' => 'Kecerdasan Buatan (AI)', 'sks' => 3, 'semester' => 5],
        ];

        $dosenId = DB::table('t033_users')->where('role_id', 2)->value('id');

        $now = now();
        $mataKuliahWithMeta = array_map(function ($item) use ($dosenId, $now) {
            return array_merge($item, [
                'dosen_id' => $dosenId,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }, $mataKuliah);

        // Hapus data lama agar tidak duplikat saat dijalankan ulang (aman terhadap FK)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('t033_mata_kuliahs')->truncate(); 

        // Masukkan 13 data dummy ke tabel spesifik
        DB::table('t033_mata_kuliahs')->insert($mataKuliahWithMeta);

        // Buat contoh KRS awal untuk mahasiswa demo jika ada
        $mahasiswaId = DB::table('t033_users')->where('role_id', 3)->value('id');
        if ($mahasiswaId) {
            DB::table('t033_krs')->where('mahasiswa_id', $mahasiswaId)->delete();
            $initialCourses = DB::table('t033_mata_kuliahs')
                ->whereIn('kode_mk', ['TIF201', 'TIF202'])
                ->get();

            foreach ($initialCourses as $mk) {
                DB::table('t033_krs')->insert([
                    'mahasiswa_id' => $mahasiswaId,
                    'mata_kuliah_id' => $mk->id,
                    'semester' => 'Ganjil 2026',
                    'status' => 'Diajukan',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}