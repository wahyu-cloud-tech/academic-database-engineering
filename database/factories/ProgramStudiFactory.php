<?php

namespace Database\Factories;

use App\Models\ProgramStudi;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramStudiFactory extends Factory
{
    protected $model = ProgramStudi::class;

    public function definition(): array
    {
        return [
            'kode' => strtoupper(fake()->unique()->bothify('PR##')),
            'nama' => fake()->words(2, true),
            'jenjang' => 'S1',
            'aktif' => true,
        ];
    }
}