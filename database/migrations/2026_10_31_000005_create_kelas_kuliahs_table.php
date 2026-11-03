<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')
                ->constrained('mata_kuliahs')
                ->restrictOnDelete();
            $table->foreignId('dosen_id')
                ->nullable()
                ->constrained('dosens')
                ->nullOnDelete();
            $table->string('nama_kelas', 20);
            $table->string('tahun_akademik', 9);
            $table->enum('semester', ['ganjil', 'genap']);
            $table->unsignedSmallInteger('kapasitas')->default(30);
            $table->timestamps();

            $table->index(['tahun_akademik', 'semester']);

            $table->unique(
                ['mata_kuliah_id', 'nama_kelas', 'tahun_akademik', 'semester'],
                'kelas_periode_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas_kuliahs');
    }
};