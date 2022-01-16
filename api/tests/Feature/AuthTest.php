<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function testCanCreateUser()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;

        $this->post("/api/register", [
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

    /** @test */
    public function testCanAuthenticateAnUser()
    {
        $user = User::factory()
            ->create();

        $this->post('/api/login', [
            'username' => $user->email,
            'password' => 'senha123',
        ])
            ->assertSuccessful()
            ->assertJson($user->toArray());
    }
}
