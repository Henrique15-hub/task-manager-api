<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
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

    public function test_user_can_see_only_his_tasks()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Task::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        Task::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        $this->actingAs($user, 'sanctum');

        $response = $this->getJson(route('indexTask'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'tasks' => [
                    '*' => ['id', 'name', 'hours'],
                ],
            ]);

        $responseData = $response->json();

        foreach ($responseData['tasks'] as $tasks) {
            $this->assertEquals($user->id, $tasks['user_id']);
        }
    }

    public function test_user_cannot_view_task_of_another_user()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();

        Task::factory()->count(2)->create([
            'user_id' => $anotherUser->id,
        ]);

        $this->actingAs($user, 'sanctum');

        $response = $this->getJson(route('indexTask'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'tasks' => [
                    '*' => ['id', 'name', 'hours'],
                ],
            ]);

        $responseData = $response->json();

        $this->assertCount(0, $responseData['tasks']);
    }
}
