<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_logged_can_create_task(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $task = Task::factory()->make()->toArray();
        $response = $this->postJson(route('storeTask'), $task);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'task' => [
                'id',
                'user_id',
                'name',
                'hours',
                'created_at',
                'updated_at',
            ],
        ]);

        $this->assertDatabaseHas('tasks', [
            'user_id' => $user->id,
            'name' => $task['name'],
            'hours' => $task['hours'],
        ]);

    }

    public function test_user_logged_can_delete_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $task = Task::factory()->create();

        $response = $this->deleteJson(route('destroyTask', $task->id));
        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
            ]);

    }
}
