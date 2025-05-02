<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_account(): void
    {
        $user = [
            'name' => 'Henrique',
            'email' => 'mail@mail.com',
            'password' => '12345678',
        ];
        $response = $this->postJson(route('storeUser'), $user)
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'user' => [
                    'name',
                    'email',
                ],
            ]);
        $this->assertDatabaseHas('users', [
            'email' => 'mail@mail.com',
        ]);

    }
}
