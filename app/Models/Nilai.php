<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    // Jika di migration pakai akhiran 's', ganti jadi 't033_nilais'
    protected $table = 't033_nilais'; 
    
    protected $fillable = ['mahasiswa_id', 'dosen_id', 'mata_kuliah_id', 'semester', 'nilai_tugas', 'nilai_uts', 'nilai_uas', 'nilai_akhir', 'nilai_huruf', 'status'];

    protected function casts(): array
    {
        return [
            'nilai_tugas' => 'decimal:2', 
            'nilai_uts' => 'decimal:2', 
            'nilai_uas' => 'decimal:2', 
            'nilai_akhir' => 'decimal:2'
        ];
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}