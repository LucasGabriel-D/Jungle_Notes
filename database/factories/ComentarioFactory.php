<?php

namespace Database\Factories;

use App\Models\Apunte;
use App\Models\Comentario;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Comentario> */
class ComentarioFactory extends Factory
{
    protected $model = Comentario::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'apunte_id' => Apunte::factory(),
            'contenido' => fake()->paragraph(),
        ];
    }
}
