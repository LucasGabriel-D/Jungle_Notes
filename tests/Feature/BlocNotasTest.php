<?php

namespace Tests\Feature;

use App\Models\Nota;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BlocNotasTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_component(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('dashboard'))->assertOk();
    }

    public function test_mount_sets_today(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test('bloc-notas')
            ->assertSet('fechaSeleccionada', now()->toDateString())
            ->assertSet('mesActual', now()->month)
            ->assertSet('anioActual', now()->year);
    }

    public function test_can_create_nota(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test('bloc-notas')
            ->set('contenido', 'Estudiar para el examen')
            ->call('guardarNota')
            ->assertHasNoErrors()
            ->assertSet('contenido', '');

        $this->assertDatabaseHas('notas', ['contenido' => 'Estudiar para el examen']);
    }

    public function test_validation_on_guardar(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test('bloc-notas')
            ->set('contenido', '')
            ->call('guardarNota')
            ->assertHasErrors(['contenido']);
    }

    public function test_can_delete_own_nota(): void
    {
        $user = User::factory()->create();
        $nota = Nota::factory()->for($user)->create();

        $this->actingAs($user);

        Livewire::test('bloc-notas')
            ->call('eliminarNota', $nota->id);

        $this->assertDatabaseMissing('notas', ['id' => $nota->id]);
    }

    public function test_cannot_delete_others_nota(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $nota = Nota::factory()->for($owner)->create();

        $this->actingAs($other);

        Livewire::test('bloc-notas')
            ->call('eliminarNota', $nota->id);

        $this->assertDatabaseHas('notas', ['id' => $nota->id]);
    }

    public function test_can_navigate_months(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $nowMonth = now()->month;
        $prevMonth = $nowMonth === 1 ? 12 : $nowMonth - 1;

        Livewire::test('bloc-notas')
            ->assertSet('mesActual', $nowMonth)
            ->call('mesAnterior')
            ->assertSet('mesActual', $prevMonth)
            ->call('mesSiguiente')
            ->assertSet('mesActual', $nowMonth);
    }

    public function test_select_date(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test('bloc-notas')
            ->call('seleccionarFecha', '2026-07-15')
            ->assertSet('fechaSeleccionada', '2026-07-15')
            ->assertSet('contenido', '');
    }

    public function test_render_shows_days_with_notes(): void
    {
        $user = User::factory()->create();
        Nota::factory()->for($user)->create(['fecha' => now()->format('Y-m-d')]);
        $this->actingAs($user);

        Livewire::test('bloc-notas')
            ->assertSee(now()->format('Y-m-d'));
    }
}
