<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class MataKuliahFactory extends Factory { protected $model=\App\Models\MataKuliah::class; public function definition(): array { return ['kode'=>strtoupper(fake()->unique()->bothify('MK###')),'nama'=>fake()->words(3,true),'sks'=>fake()->numberBetween(2,4),'semester_rekomendasi'=>fake()->numberBetween(1,8),'aktif'=>true]; } }
