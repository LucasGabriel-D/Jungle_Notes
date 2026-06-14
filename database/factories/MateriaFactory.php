<?php

namespace Database\Factories;

use App\Models\Materia;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Materia> */
class MateriaFactory extends Factory
{
    protected $model = Materia::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->words(3, true),
            'descripcion' => fake()->sentence(),
            'anio' => fake()->numberBetween(1, 5),
        ];
    }
}
