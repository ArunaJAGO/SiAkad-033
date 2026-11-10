<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Krs extends Model
{
    // Wajib ada awalan t033_
    protected $table = 't033_krs'; 
    
    protected $fillable = ['mahasiswa_id', 'mata_kuliah_id', 'semester', 'status'];

    public function mahasiswa(): BelongsTo 
    { 
        return $this->belongsTo(User::class, 'mahasiswa_id'); 
    }
    
    public function mataKuliah(): BelongsTo 
    { 
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id'); 
    }
}