<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class DosenFactory extends Factory { protected $model=\App\Models\Dosen::class; public function definition(): array { return ['nidn'=>fake()->unique()->numerify('##########'),'nama'=>fake()->name(),'email'=>fake()->unique()->safeEmail(),'aktif'=>true]; } }
