<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class ProgramStudiFactory extends Factory { protected $model=\App\Models\ProgramStudi::class; public function definition(): array { return ['kode'=>strtoupper(fake()->unique()->bothify('PR##')),'nama'=>fake()->words(2,true),'jenjang'=>'S1','aktif'=>true]; } }
