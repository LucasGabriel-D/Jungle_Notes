<?php

namespace Database\Factories;

use App\Models\Nota;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Nota> */
class NotaFactory extends Factory
{
    protected $model = Nota::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'contenido' => fake()->sentence(),
            'fecha' => fake()->date(),
        ];
    }
}
