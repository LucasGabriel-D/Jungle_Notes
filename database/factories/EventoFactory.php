<?php

namespace Database\Factories;

use App\Models\Evento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Evento> */
class EventoFactory extends Factory
{
    protected $model = Evento::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'titulo' => fake()->sentence(3),
            'fecha_inicio' => fake()->date(),
            'fecha_fin' => fake()->optional()->date(),
            'tipo' => fake()->randomElement(['examen', 'presentacion', 'otro']),
            'color' => fake()->hexColor(),
        ];
    }
}
