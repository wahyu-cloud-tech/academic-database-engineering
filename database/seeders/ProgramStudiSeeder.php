<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['TI', 'Teknik Informatika'],
            ['SI', 'Sistem Informasi'],
            ['MI', 'Manajemen Informatika'],
        ] as [$kode, $nama]) {
            ProgramStudi::create([
                'kode' => $kode,
                'nama' => $nama,
                'jenjang' => 'S1',
                'aktif' => true,
            ]);
        }
    }
}