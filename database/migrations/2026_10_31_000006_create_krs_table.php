<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::create('krs', function (Blueprint $table) { $table->id(); $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->restrictOnDelete(); $table->string('tahun_akademik',9); $table->enum('semester',['ganjil','genap']); $table->enum('status',['draft','diajukan','disetujui'])->default('draft'); $table->timestamp('diajukan_at')->nullable(); $table->timestamps(); $table->unique(['mahasiswa_id','tahun_akademik','semester'],'krs_mahasiswa_periode_unique'); }); }
 public function down(): void { Schema::dropIfExists('krs'); }
};
