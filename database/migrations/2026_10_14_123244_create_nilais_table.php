<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t033_nilais', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('dosen_id')->nullable();
            $table->unsignedBigInteger('mata_kuliah_id');
            
            $table->string('semester');
            $table->decimal('nilai_tugas', 5, 2)->nullable();
            $table->decimal('nilai_uts', 5, 2)->nullable();
            $table->decimal('nilai_uas', 5, 2)->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->string('nilai_huruf', 2)->nullable();
            $table->string('status')->nullable(); // Lulus / Tidak Lulus

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t033_nilais');
    }
};