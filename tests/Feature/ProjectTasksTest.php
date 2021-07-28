<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Task;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    public function guest_cannot_add_tasks_to_project()
    {
        
        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');

    }

    /** @test */

    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', ['body' => "Test task"]);

        $this->assertDatabaseMissing('tasks',['body' => 'Test task']);


    }

     /** @test */

    public function only_the_owner_of_a_project_may_update_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $task = $project->addTask('test task');

        $this->patch($task->path(), ['body' => "changed task"])->assertStatus(403);

        $this->assertDatabaseMissing('tasks',['body' => 'changed task']);


    }


    /** @test */

    public function a_project_can_have_tasks()
    {
        $this->signIn();

        
        $project = auth()->user()->projects()->create(
            Project::factory()->raw()
        );

        $this->post($project->path() . '/tasks', ['body' => "Test task"]);

        $this->get($project->path())
             ->assertSee('Test task');
    }

    /** @test */

    public function a_test_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        
        $project = auth()->user()->projects()->create(
            Project::factory()->raw()
        );

        $task = $project->addTask("test task");

        $this->patch($project->path() . '/tasks/' . $task->id, [
            'body' => 'changed test',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed test',
            'completed' => true
        ]);
    }

    /** @test */

    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            Project::factory()->raw()
        );

        $attributes = Task::factory()->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
