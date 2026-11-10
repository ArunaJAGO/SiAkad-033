<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengumuman extends Model
{
    // Jika di migration tanpa 's', ganti jadi 't033_pengumuman'
    protected $table = 't033_pengumumans'; 
    
    protected $fillable = ['dosen_id', 'judul', 'isi', 'target_role', 'published_at'];
    
    protected function casts(): array 
    { 
        return ['published_at' => 'datetime']; 
    }
    
    public function dosen(): BelongsTo 
    { 
        return $this->belongsTo(User::class, 'dosen_id'); 
    }
}