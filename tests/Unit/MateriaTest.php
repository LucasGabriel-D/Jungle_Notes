<?php

namespace Tests\Unit;

use App\Models\Apunte;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MateriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create();

        $this->assertInstanceOf(User::class, $materia->user);
        $this->assertTrue($materia->user->is($user));
    }

    public function test_has_many_apuntes(): void
    {
        $materia = Materia::factory()->create();
        $apunte = Apunte::factory()->for($materia)->create();

        $this->assertTrue($materia->apuntes->contains($apunte));
    }

    public function test_deleting_materia_cascades_apuntes(): void
    {
        $materia = Materia::factory()->create();
        Apunte::factory()->for($materia)->create();

        $materia->delete();

        $this->assertDatabaseMissing('apuntes', ['materia_id' => $materia->id]);
    }
}
