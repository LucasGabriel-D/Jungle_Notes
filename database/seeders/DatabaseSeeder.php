<?php

namespace Database\Seeders;

use App\Models\Materia;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Materia::factory()->createMany([
            ['user_id' => $user->id, 'nombre' => 'Matemática I', 'descripcion' => 'Álgebra y geometría analítica', 'anio' => 1],
            ['user_id' => $user->id, 'nombre' => 'Física I', 'descripcion' => 'Mecánica clásica', 'anio' => 1],
            ['user_id' => $user->id, 'nombre' => 'Programación I', 'descripcion' => 'Fundamentos de la programación estructurada', 'anio' => 1],
            ['user_id' => $user->id, 'nombre' => 'Inglés Técnico I', 'descripcion' => 'Lectocomprensión de textos técnicos', 'anio' => 1],
            ['user_id' => $user->id, 'nombre' => 'Matemática II', 'descripcion' => 'Cálculo diferencial e integral', 'anio' => 2],
            ['user_id' => $user->id, 'nombre' => 'Física II', 'descripcion' => 'Electromagnetismo y ondas', 'anio' => 2],
            ['user_id' => $user->id, 'nombre' => 'Programación II', 'descripcion' => 'Programación orientada a objetos', 'anio' => 2],
            ['user_id' => $user->id, 'nombre' => 'Base de Datos I', 'descripcion' => 'Modelado y consultas SQL', 'anio' => 2],
            ['user_id' => $user->id, 'nombre' => 'Análisis de Sistemas', 'descripcion' => 'Ciclo de vida del software', 'anio' => 3],
            ['user_id' => $user->id, 'nombre' => 'Redes I', 'descripcion' => 'Fundamentos de redes y comunicaciones', 'anio' => 3],
        ]);
    }
}
