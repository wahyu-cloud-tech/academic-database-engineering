<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_studi_id')
                ->constrained('program_studis')
                ->restrictOnDelete();
            $table->string('nim', 20)->unique();
            $table->string('nama', 100);
            $table->string('email')->unique();
            $table->unsignedSmallInteger('angkatan');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
            $table->index(['program_studi_id', 'angkatan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};