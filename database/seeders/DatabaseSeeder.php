<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProgramStudiSeeder::class,
            DosenSeeder::class,
            MataKuliahSeeder::class,
            MahasiswaSeeder::class,
            KelasKuliahSeeder::class,
        ]);
    }
}