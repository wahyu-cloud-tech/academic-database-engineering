<?php
namespace Database\Factories;
use App\Models\ProgramStudi;
use Illuminate\Database\Eloquent\Factories\Factory;
class MahasiswaFactory extends Factory {
 protected $model = \App\Models\Mahasiswa::class;
 public function definition(): array { return ['program_studi_id'=>ProgramStudi::factory(),'nim'=>fake()->unique()->numerify('42########'),'nama'=>fake()->name(),'email'=>fake()->unique()->safeEmail(),'angkatan'=>fake()->numberBetween(2022,2026),'aktif'=>true]; }
 public function nonaktif(): static { return $this->state(fn(array $attributes)=>['aktif'=>false]); }
}
