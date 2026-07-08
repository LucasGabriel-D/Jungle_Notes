<?php

namespace Tests\Feature;

use App\Models\Apunte;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ManageApuntesTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_component(): void
    {
        $user = User::factory()->create();
        Materia::factory()->for($user)->create();

        $this->actingAs($user);
        $this->get(route('apuntes.index'))->assertOk();
    }

    public function test_guest_redirected_to_login(): void
    {
        $this->get(route('apuntes.index'))->assertRedirect(route('login'));
    }

    public function test_can_create_apunte(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create();

        $this->actingAs($user);

        Livewire::test('manage-apuntes')
            ->set('titulo', 'Apunte de prueba')
            ->set('descripcion', 'Descripción')
            ->set('materia_id', $materia->id)
            ->set('archivo', UploadedFile::fake()->create('documento.pdf', 100))
            ->call('store')
            ->assertHasNoErrors()
            ->assertSet('titulo', '');

        $this->assertDatabaseHas('apuntes', ['titulo' => 'Apunte de prueba']);
    }

    public function test_validation_errors_on_store(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test('manage-apuntes')
            ->call('store')
            ->assertHasErrors(['titulo', 'materia_id', 'archivo']);
    }

    public function test_can_delete_own_apunte(): void
    {
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create();
        $apunte = Apunte::factory()->for($user)->for($materia)->create();

        $this->actingAs($user);

        Livewire::test('manage-apuntes')
            ->call('delete', $apunte->id);

        $this->assertDatabaseMissing('apuntes', ['id' => $apunte->id]);
    }

    public function test_cannot_delete_others_apunte(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $materia = Materia::factory()->for($owner)->create();
        $apunte = Apunte::factory()->for($owner)->for($materia)->create();

        $this->actingAs($other);

        Livewire::test('manage-apuntes')
            ->call('delete', $apunte->id);

        $this->assertDatabaseHas('apuntes', ['id' => $apunte->id]);
    }

    public function test_search_filters_apuntes(): void
    {
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create(['nombre' => 'Matemática']);
        Apunte::factory()->for($user)->for($materia)->create(['titulo' => 'Álgebra']);
        Apunte::factory()->for($user)->for($materia)->create(['titulo' => 'Geometría']);

        $this->actingAs($user);

        Livewire::test('manage-apuntes')
            ->set('search', 'Álgebra')
            ->assertSee('Álgebra')
            ->assertDontSee('Geometría');
    }
}
