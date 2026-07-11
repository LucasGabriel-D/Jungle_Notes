<?php

namespace Tests\Feature;

use App\Models\Apunte;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApunteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_index_returns_all_apuntes(): void
    {
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create();
        Apunte::factory()->count(3)->for($user)->for($materia)->create();

        $response = $this->getJson('/api/apuntes');

        $response->assertOk()->assertJsonCount(3);
    }

    public function test_api_store_validates_without_auth(): void
    {
        $response = $this->postJson('/api/apuntes', [
            'titulo' => 'Test',
            'materia_id' => 999,
        ]);

        $response->assertUnprocessable()->assertJsonValidationErrors(['materia_id', 'archivo']);
    }

    public function test_api_store_creates_apunte(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $materia = Materia::factory()->for($user)->create();

        $response = $this->actingAs($user)->postJson('/api/apuntes', [
            'titulo' => 'API Apunte',
            'materia_id' => $materia->id,
            'archivo' => UploadedFile::fake()->create('doc.pdf', 100),
        ]);

        $response->assertCreated()->assertJson(['titulo' => 'API Apunte']);
        $this->assertDatabaseHas('apuntes', ['titulo' => 'API Apunte']);
    }

    public function test_api_store_validates(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/apuntes', []);

        $response->assertUnprocessable()->assertJsonValidationErrors(['titulo', 'materia_id', 'archivo']);
    }
}
