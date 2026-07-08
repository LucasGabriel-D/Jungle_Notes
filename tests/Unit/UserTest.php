<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_initials_returns_two_letters(): void
    {
        $user = User::factory()->make(['name' => 'Mauricio Cardozo']);
        $this->assertEquals('MC', $user->initials());
    }

    public function test_initials_single_name(): void
    {
        $user = User::factory()->make(['name' => 'Mauricio']);
        $this->assertEquals('M', $user->initials());
    }

    public function test_initials_empty_name(): void
    {
        $user = User::factory()->make(['name' => '']);
        $this->assertEquals('', $user->initials());
    }
}
