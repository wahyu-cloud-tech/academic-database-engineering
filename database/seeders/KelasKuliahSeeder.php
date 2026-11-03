<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\KelasKuliah;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class KelasKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $dosens = Dosen::all();

        foreach (MataKuliah::all() as $i => $mk) {
            foreach (['A', 'B'] as $kelas) {
                KelasKuliah::create([
                    'mata_kuliah_id' => $mk->id,
                    'dosen_id' => $dosens[$i % $dosens->count()]->id,
                    'nama_kelas' => $kelas,
                    'tahun_akademik' => '2026/2027',
                    'semester' => 'ganjil',
                    'kapasitas' => 30,
                ]);
            }
        }
    }
}