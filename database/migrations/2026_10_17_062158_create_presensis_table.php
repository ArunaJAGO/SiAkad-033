<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t033_presensis', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('dosen_id')->nullable();
            $table->unsignedBigInteger('mata_kuliah_id');
            
            $table->date('tanggal');
            $table->string('status'); // Hadir, Izin, Sakit, Alpa
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t033_presensis');
    }
};