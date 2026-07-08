<?php

namespace Tests\Unit;

use App\Models\Apunte;
use App\Models\Comentario;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApunteTest extends TestCase
{
    use RefreshDatabase;

    public function test_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $apunte = Apunte::factory()->for($user)->create();

        $this->assertTrue($apunte->user->is($user));
    }

    public function test_belongs_to_materia(): void
    {
        $materia = Materia::factory()->create();
        $apunte = Apunte::factory()->for($materia)->create();

        $this->assertTrue($apunte->materia->is($materia));
    }

    public function test_has_many_comentarios(): void
    {
        $apunte = Apunte::factory()->create();
        $comentario = Comentario::factory()->for($apunte)->create();

        $this->assertTrue($apunte->comentarios->contains($comentario));
    }
}
