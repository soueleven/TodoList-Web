<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateTask()
    {
        $updateData = ['text' => 'testCreateTask'];

        $this->json('POST', 'api/tasks', $updateData, ['Accept' => 'application/json'])
            ->assertStatus(201);

        $newTask = Task::where('text', 'testCreateTask')->first();
        $this->assertNotNull($newTask);
    }

    public function testUpdateTask()
    {
        $task = Task::factory()->create([
            'text' => 'test',
        ]);

        $updateData = ['text' => 'testUpdateTask', 'status' => 1];

        $this->json('PUT', 'api/tasks/' . $task->id, $updateData, ['Accept' => 'application/json'])
            ->assertStatus(200);

        $newTask = Task::where('id', $task->id)->first();
        $this->assertEquals('testUpdateTask', $newTask->text);
        $this->assertEquals(1, $newTask->status);

    }

    public function testDeleteTask()
    {
        $task = Task::factory()->create([
            'text' => 'test',
        ]);

        $this->json('DELETE', 'api/tasks/' . $task->id, ['Accept' => 'application/json'])
            ->assertStatus(200);
        $newTask = Task::where('id', $task->id)->first();
        $this->assertNull($newTask);
    }

    public function testGetTask()
    {
        $task = Task::factory()->create([
            'text' => 'test',
        ]);

        $this->json('GET', 'api/tasks', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
