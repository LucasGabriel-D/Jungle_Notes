<?php

namespace Tests\Feature;

use App\Livewire\ComentariosApunte;
use App\Models\Apunte;
use App\Models\Comentario;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ComentarioControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_index_returns_comentarios(): void
    {
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create();
        $apunte = Apunte::factory()->for($user)->for($materia)->create();
        Comentario::factory()->count(2)->for($user)->for($apunte)->create();

        $response = $this->actingAs($user)->getJson(route('comentarios.index'));
        $response->assertOk()->assertJsonCount(2);
    }

    public function test_api_store_creates_comentario(): void
    {
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create();
        $apunte = Apunte::factory()->for($user)->for($materia)->create();

        $response = $this->actingAs($user)->postJson(route('comentarios.store'), [
            'apunte_id' => $apunte->id,
            'contenido' => 'Comentario de prueba',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('comentarios', ['contenido' => 'Comentario de prueba']);
    }

    public function test_api_destroy_no_ownership_check(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $materia = Materia::factory()->for($other)->create();
        $apunte = Apunte::factory()->for($other)->for($materia)->create();
        $comentario = Comentario::factory()->for($other)->for($apunte)->create();

        $response = $this->actingAs($user)->deleteJson(route('comentarios.destroy', $comentario));

        $response->assertNoContent();
        $this->assertDatabaseMissing('comentarios', ['id' => $comentario->id]);
    }

    public function test_livewire_can_store_comentario(): void
    {
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create();
        $apunte = Apunte::factory()->for($user)->for($materia)->create();

        $this->actingAs($user);

        Livewire::test(ComentariosApunte::class, ['apunte_id' => $apunte->id])
            ->set('contenido', 'Comentario desde Livewire')
            ->call('store')
            ->assertOk()
            ->assertHasNoErrors()
            ->assertSet('contenido', '');

        $this->assertDatabaseHas('comentarios', ['contenido' => 'Comentario desde Livewire']);
    }

    public function test_livewire_cannot_delete_others_comentario(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $materia = Materia::factory()->for($owner)->create();
        $apunte = Apunte::factory()->for($owner)->for($materia)->create();
        $comentario = Comentario::factory()->for($owner)->for($apunte)->create();

        $this->actingAs($other);

        Livewire::test(ComentariosApunte::class, ['apunte_id' => $apunte->id])
            ->call('delete', $comentario->id);

        $this->assertDatabaseHas('comentarios', ['id' => $comentario->id]);
    }
}
