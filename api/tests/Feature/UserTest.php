<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testCanListUsers()
    {
        User::factory()
            ->count(5)
            ->create();

        $this->get('/api/users')
            ->assertSuccessful()
            ->assertJsonCount(5);
    }

    public function testCanGetUser()
    {
        $user = User::factory()
            ->create();

        $this->get("/api/users/{$user->id}")
            ->assertSuccessful()
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]);
    }

    public function testCanCreateUser()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;

        $this->post("/api/users", [
            'name' => $name,
            'email' => $email,
            'password' => 'senha123',
        ])->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email
        ]);

        $user = User::where('email', $email)->firstOrFail();
        $this->assertTrue(Hash::check('senha123', $user->password));
    }
}
