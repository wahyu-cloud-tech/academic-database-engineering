<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['1000000001', 'Dr. Andi Pratama', 'andi@kampus.ac.id'],
            ['1000000002', 'Siti Rahmawati, M.Kom', 'siti@kampus.ac.id'],
            ['1000000003', 'Budi Santoso, M.TI', 'budi@kampus.ac.id'],
            ['1000000004', 'Rina Puspita, M.Kom', 'rina@kampus.ac.id'],
        ] as [$nidn, $nama, $email]) {
            Dosen::create(
                compact('nidn', 'nama', 'email') + ['aktif' => true]
            );
        }
    }
}