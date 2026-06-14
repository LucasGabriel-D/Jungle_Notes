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
        Materia::factory()->createMany([
            ['nombre' => 'Matemática I', 'descripcion' => 'Álgebra y geometría analítica', 'anio' => 1],
            ['nombre' => 'Física I', 'descripcion' => 'Mecánica clásica', 'anio' => 1],
            ['nombre' => 'Programación I', 'descripcion' => 'Fundamentos de la programación estructurada', 'anio' => 1],
            ['nombre' => 'Inglés Técnico I', 'descripcion' => 'Lectocomprensión de textos técnicos', 'anio' => 1],
            ['nombre' => 'Matemática II', 'descripcion' => 'Cálculo diferencial e integral', 'anio' => 2],
            ['nombre' => 'Física II', 'descripcion' => 'Electromagnetismo y ondas', 'anio' => 2],
            ['nombre' => 'Programación II', 'descripcion' => 'Programación orientada a objetos', 'anio' => 2],
            ['nombre' => 'Base de Datos I', 'descripcion' => 'Modelado y consultas SQL', 'anio' => 2],
            ['nombre' => 'Análisis de Sistemas', 'descripcion' => 'Ciclo de vida del software', 'anio' => 3],
            ['nombre' => 'Redes I', 'descripcion' => 'Fundamentos de redes y comunicaciones', 'anio' => 3],
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
