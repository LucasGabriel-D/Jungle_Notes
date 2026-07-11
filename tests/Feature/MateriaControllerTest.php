<?php

namespace Tests\Feature;

use App\Models\Materia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MateriaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_redirected_to_login(): void
    {
        $this->get(route('materias.index'))->assertRedirect(route('login'));
    }

    public function test_index_shows_own_materias(): void
    {
        $user = User::factory()->create();
        Materia::factory()->for($user)->create(['nombre' => 'Programación III']);
        Materia::factory()->for($user)->create(['nombre' => 'Base de Datos']);

        $this->actingAs($user);
        $this->get(route('materias.index'))
            ->assertOk()
            ->assertSee('Programación III')
            ->assertSee('Base de Datos');
    }

    public function test_index_does_not_show_others_materias(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        Materia::factory()->for($other)->create(['nombre' => 'Oculta']);

        $this->actingAs($user);
        $this->get(route('materias.index'))
            ->assertOk()
            ->assertDontSee('Oculta');
    }

    public function test_can_create_materia(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('materias.store'), [
            'nombre' => 'Programación III',
            'descripcion' => 'Materia principal del proyecto',
            'anio' => 3,
        ])->assertRedirect(route('materias.index'));

        $this->assertDatabaseHas('materias', [
            'nombre' => 'Programación III',
            'user_id' => $user->id,
        ]);
    }

    public function test_store_validates(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('materias.store'), [])
            ->assertSessionHasErrors(['nombre', 'anio']);
    }

    public function test_store_unique_per_user(): void
    {
        $user = User::factory()->create();
        Materia::factory()->for($user)->create(['nombre' => 'Duplicada']);
        $this->actingAs($user);

        $this->post(route('materias.store'), [
            'nombre' => 'Duplicada',
            'anio' => 2,
        ])->assertSessionHasErrors('nombre');
    }

    public function test_can_show_own_materia(): void
    {
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create();

        $this->actingAs($user);
        $this->get(route('materias.show', $materia))->assertOk();
    }

    public function test_cannot_show_others_materia(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $materia = Materia::factory()->for($other)->create();

        $this->actingAs($user);
        $this->get(route('materias.show', $materia))->assertForbidden();
    }

    public function test_can_update_own_materia(): void
    {
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create();

        $this->actingAs($user);
        $this->put(route('materias.update', $materia), [
            'nombre' => 'Actualizada',
            'anio' => 4,
        ])->assertRedirect(route('materias.index'));

        $this->assertDatabaseHas('materias', ['id' => $materia->id, 'nombre' => 'Actualizada']);
    }

    public function test_cannot_update_others_materia(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $materia = Materia::factory()->for($other)->create();

        $this->actingAs($user);
        $this->put(route('materias.update', $materia), [
            'nombre' => 'Hackeada',
            'anio' => 1,
        ])->assertForbidden();
    }

    public function test_can_delete_own_materia(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create();

        $this->actingAs($user);
        $this->delete(route('materias.destroy', $materia))
            ->assertRedirect(route('materias.index'));

        $this->assertDatabaseMissing('materias', ['id' => $materia->id]);
    }

    public function test_cannot_delete_others_materia(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $materia = Materia::factory()->for($other)->create();

        $this->actingAs($user);
        $this->delete(route('materias.destroy', $materia))->assertForbidden();

        $this->assertDatabaseHas('materias', ['id' => $materia->id]);
    }
}
