<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['IF101', 'Algoritma dan Pemrograman', 3, 1],
            ['IF202', 'Basis Data', 3, 3],
            ['IF303', 'Rekayasa Perangkat Lunak', 3, 5],
            ['IF304', 'Keamanan Siber', 3, 5],
            ['IF401', 'Pemrograman Web Lanjut', 3, 7],
            ['IF402', 'Jaringan Komputer', 3, 7],
            ['IF403', 'Kecerdasan Buatan', 3, 7],
            ['IF404', 'Manajemen Proyek TI', 2, 7],
        ] as [$kode, $nama, $sks, $sem]) {
            MataKuliah::create([
                'kode' => $kode,
                'nama' => $nama,
                'sks' => $sks,
                'semester_rekomendasi' => $sem,
                'aktif' => true,
            ]);
        }
    }
}