<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('t033_kelas_dosens', function (Blueprint $table) {
        $table->id();
        
        // Kolom relasi yang sudah ada (misal ke mata kuliah)
        $table->unsignedBigInteger('mata_kuliah_id'); 
        
        // ==========================================
        // TAMBAHKAN BARIS INI:
        $table->unsignedBigInteger('dosen_id'); 
        // ==========================================

        // Kolom jadwal lainnya yang sudah ada
        $table->string('hari')->nullable();
        $table->time('jam_mulai')->nullable();
        $table->time('jam_selesai')->nullable();
        $table->string('ruang')->nullable();
        $table->string('semester')->nullable();

        $table->timestamps();
        
        // (Opsional) Jika kamu mau menambahkan foreign key constraint:
        // $table->foreign('dosen_id')->references('id')->on('t033_users')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t033_kelas_dosens'); // Pastikan namanya sama persis dengan yang di up()
    }
};
