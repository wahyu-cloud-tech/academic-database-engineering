<?php
namespace Database\Seeders;
use App\Models\Mahasiswa; use App\Models\ProgramStudi; use Illuminate\Database\Seeder;
class MahasiswaSeeder extends Seeder { public function run(): void { ProgramStudi::query()->each(function(ProgramStudi $prodi){ Mahasiswa::factory()->count(18)->for($prodi)->create(); }); } }
