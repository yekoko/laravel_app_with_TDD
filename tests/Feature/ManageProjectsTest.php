<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */

    public function guests_cannot_manage_projects()
    {
        //$this->withoutExceptionHandling();
        $project = Project::factory()->create();

        $this->get('/projects')->assertRedirect('login');

        $this->get($project->path())->assertRedirect('login');

        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

   
    /** @test */

    public function a_user_can_create_a_projects()
    {
        
        $this->withoutExceptionHandling();


        $this->signIn();
        //$this->actingAs(User::factory()->create());

        $this->get('/projects/create')->assertStatus(200);

        
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'General notes here'
        ];




        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
             ->assertSee($attributes['title'])
             ->assertSee($attributes['description'])
             ->assertSee($attributes['notes']);
    }


    /** @test */

    function a_user_can_update_a_project()
    {
        $this->signIn();


        $this->withoutExceptionHandling();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->patch($project->path(), [

            'notes' => 'changed notes'

        ])->assertRedirect($project->path());

        $this->assertDatabaseHas('projects',['notes' => 'changed notes']);

    }

     /** @test */

     public function a_user_can_view_their_projects()
     {
        $this->signIn();

        $this->withoutExceptionHandling();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
             ->assertSee($project->title)
             ->assertSee($project->description);
     }

     /** @test */

     public function auth_user_cannot_view_other_projects()
     {
        $this->signIn();

        //$this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get($project->path())
             ->assertStatus(403);
     }

     /** @test */

     public function auth_user_cannot_update_other_projects()
     {
        $this->signIn();

        //$this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->patch($project->path(), [])
             ->assertStatus(403);
     }


    /** @test */

    public function a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */

    public function a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    
}
