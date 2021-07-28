<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
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

        // $project = Project::factory()->create();

        // $task = $project->addTask('test task');

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks[0]->path(), ['body' => "changed task"])->assertStatus(403);

        $this->assertDatabaseMissing('tasks',['body' => 'changed task']);


    }


    /** @test */

    public function a_project_can_have_tasks()
    {
        // $this->signIn();

        
        // $project = auth()->user()->projects()->create(
        //     Project::factory()->raw()
        // );

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
             ->post($project->path() . '/tasks', ['body' => "Test task"]);

        $this->get($project->path())
             ->assertSee('Test task');
    }

    /** @test */

    public function a_test_can_be_updated()
    {
        
        // $project = app(ProjectFactory::class)
        //     ->ownedBy($this->signIn())
        //     ->withTasks(1)
        //     ->create();

        $project = ProjectFactory::withTasks(1)->create();
        
        // $project = auth()->user()->projects()->create(
        //     Project::factory()->raw()
        // );

        // $task = $project->addTask("test task");

        $this->actingAs($project->owner)
             ->patch($project->tasks->first()->path(), [
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
        // $this->signIn();

        // $project = auth()->user()->projects()->create(
        //     Project::factory()->raw()
        // );

        $project = ProjectFactory::create();

        $attributes = Task::factory()->raw(['body' => '']);

        $this->actingAs($project->owner)
             ->post($project->path() . '/tasks', $attributes)
             ->assertSessionHasErrors('body');
    }
}
