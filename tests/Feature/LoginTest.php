<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can access the login page', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

it('can login with valid credentials', function () {
    // Create a test user
    $user = \App\Models\User::factory()->create([
        'username' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/login', [
        'username' => 'test@example.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticatedAs($user);
});

it('cannot login with invalid credentials', function () {
    $response = $this->post('/login', [
        'username' => 'invalid@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors();
    $this->assertGuest();
});

it('validates required fields', function () {
    $response = $this->post('/login', []);

    $response->assertSessionHasErrors(['username', 'password']);
});
