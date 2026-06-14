<?php

namespace Database\Factories;

use App\Models\Apunte;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Apunte> */
class ApunteFactory extends Factory
{
    protected $model = Apunte::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'materia_id' => Materia::factory(),
            'titulo' => fake()->words(4, true),
            'descripcion' => fake()->optional()->paragraph(),
            'ruta_archivo' => 'apuntes/materia_1/'.fake()->uuid().'.pdf',
        ];
    }
}
