<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testCanListUsers()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        User::factory()
            ->count(5)
            ->create();

        $this->get('/api/users')
            ->assertSuccessful()
            ->assertJsonCount(6);
    }

    public function testCanGetUser()
    {
        Sanctum::actingAs(
            $user = User::factory()->create(),
            ['*']
        );

        $this->get("/api/users/{$user->id}")
            ->assertSuccessful()
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]);
    }

}
