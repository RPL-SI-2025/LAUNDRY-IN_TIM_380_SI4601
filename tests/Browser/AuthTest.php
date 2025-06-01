<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_register()
    {
        $userData = [
            'name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $userData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'username' => $userData['username'],
            'name' => $userData['name'],
        ]);
    }

    public function test_user_cannot_register_with_invalid_data()
    {
        $userData = [
            'name' => '',
            'username' => 'invalid username with spaces',
            'password' => 'short',
            'password_confirmation' => 'different',
        ];

        $response = $this->post('/register', $userData);

        $response->assertStatus(422);
        $response->assertSessionHasErrors(['name', 'username', 'password']);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => bcrypt('password123')
        ]);

        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'password123',
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => bcrypt('password123')
        ]);

        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
    }

    public function test_username_must_be_unique()
    {
        $existingUser = User::factory()->create([
            'username' => 'existinguser'
        ]);

        $userData = [
            'name' => $this->faker->name,
            'username' => 'existinguser', // Using same username as existing user
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $userData);

        $response->assertStatus(422);
        $response->assertSessionHasErrors(['username']);
    }
}