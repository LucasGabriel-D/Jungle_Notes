<?php

namespace Tests\Feature;

use App\Models\Evento;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CalendarioTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_component(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('calendario'))->assertOk();
    }

    public function test_guest_redirected_to_login(): void
    {
        $this->get(route('calendario'))->assertRedirect(route('login'));
    }

    public function test_abrir_modal(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test('calendario')
            ->call('abrirModal')
            ->assertSet('mostrarModal', true)
            ->assertSet('titulo', '')
            ->assertSet('tipo', 'examen');
    }

    public function test_abrir_modal_with_date(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test('calendario')
            ->call('abrirModal', '2026-12-25')
            ->assertSet('fechaInicio', '2026-12-25');
    }

    public function test_can_create_evento(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test('calendario')
            ->call('abrirModal')
            ->set('titulo', 'Examen final')
            ->set('fechaInicio', '2026-12-01')
            ->set('tipo', 'examen')
            ->call('guardar')
            ->assertHasNoErrors()
            ->assertSet('mostrarModal', false)
            ->assertDispatched('eventosActualizados');

        $this->assertDatabaseHas('eventos', ['titulo' => 'Examen final']);
    }

    public function test_validation_on_guardar(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test('calendario')
            ->set('titulo', '')
            ->set('fechaInicio', '')
            ->call('guardar')
            ->assertHasErrors(['titulo', 'fechaInicio']);
    }

    public function test_can_edit_evento(): void
    {
        $user = User::factory()->create();
        $evento = Evento::factory()->for($user)->create();

        $this->actingAs($user);

        Livewire::test('calendario')
            ->call('abrirEditar', $evento->id)
            ->assertSet('editando', true)
            ->assertSet('mostrarModal', true)
            ->assertSet('titulo', $evento->titulo)
            ->set('titulo', 'Editado')
            ->call('guardar');

        $this->assertDatabaseHas('eventos', ['id' => $evento->id, 'titulo' => 'Editado']);
    }

    public function test_can_delete_evento(): void
    {
        $user = User::factory()->create();
        $evento = Evento::factory()->for($user)->create();

        $this->actingAs($user);

        Livewire::test('calendario')
            ->call('abrirEditar', $evento->id)
            ->call('eliminar')
            ->assertSet('mostrarModal', false);

        $this->assertDatabaseMissing('eventos', ['id' => $evento->id]);
    }

    public function test_get_eventos_returns_array(): void
    {
        $user = User::factory()->create();
        $evento = Evento::factory()->for($user)->create();

        $this->actingAs($user);

        Livewire::test('calendario')
            ->assertSet('titulo', '');
    }
}
