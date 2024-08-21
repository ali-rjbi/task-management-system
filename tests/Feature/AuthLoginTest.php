<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;

    protected array $userData = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->userData = [
            'name' => 'Ali Ahmadi',
            'email' => 'ali@gmail.com',
            'password' => Hash::make('12345678')
        ];

        User::factory()->create($this->userData);
    }

    public function user_can_login_successfully(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => $this->userData['email'],
            'password' => '12345678',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'created_at',
                ],
                'token',
            ]);
    }

    public function user_cannot_login_with_incorrect_password(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => $this->userData['email'],
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);
    }

    public function user_cannot_login_with_invalid_email(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'wrongemail@gmail.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);
    }

    public function login_requires_email_and_password(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'password' => '12345678',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        $response = $this->postJson('/api/auth/login', [
            'email' => $this->userData['email'],
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    public function login_fails_with_empty_request_body(): void
    {
        $response = $this->postJson('/api/auth/login');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }

    public function login_fails_with_email_with_leading_or_trailing_spaces(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => '   ali@gmail.com   ',
            'password' => '12345678',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);
    }

    public function login_fails_with_password_with_leading_or_trailing_spaces(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => $this->userData['email'],
            'password' => ' 12345678 ',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);
    }

    public function login_fails_for_non_existent_user(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'nonexistentuser@gmail.com',
            'password' => 'any_password',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);
    }

    public function login_fails_if_user_account_is_not_verified(): void
    {
        // Create user without email verification
        $user = User::create([
            'name' => 'Unverified User',
            'email' => 'unverified@example.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => null, // User not verified
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);
    }
}
