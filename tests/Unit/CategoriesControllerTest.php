<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;
use Psy\Exception\FatalErrorException;
use App\Models\User;

class CategoriesControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_needs_to_be_protected_for_non_users()
    {
        $this->get('/admin/categories')->assertStatus(302);
        $this->post('/admin/categories')->assertStatus(302);
        $this->put('/admin/categories/1')->assertStatus(302);
        $this->delete('/admin/categories/1')->assertStatus(302);
    }

    /** @test */
    public function store()
    {
        $user     = factory(\App\Models\User::class)->create();
        $data     = ['text' => 'Category'];

        $this->actingAs($user)
             ->post('/admin/categories', $data);

        $this->assertDatabaseHas('categories', ['text' => 'Category']);
    }

    /** @test */
    public function it_should_validate_required_fields_on_create()
    {
        $user     = factory(\App\Models\User::class)->create();
        $data     = [];

        $this->actingAs($user)
             ->post('/admin/categories', $data)
             ->assertSessionHasErrors(['text']);
    }

    /** @test */
    public function update()
    {
        $user     = factory(\App\Models\User::class)->create();
        $category = factory(\App\Models\Category::class)->create();

        $category->text = "updated";

        $this->actingAs($user)
             ->put('/admin/categories/' . $category->id, $category->toArray());

        $this->assertDatabaseHas('categories', ['text' => 'updated']);
    }

    /** @test */
    public function it_should_validate_required_fields_on_update()
    {
        $user = factory(\App\Models\User::class)->create();
        $category  = factory(\App\Models\Category::class)->create();
        $data = [];
        $this->actingAs($user)
             ->put('/admin/categories/' . $category->id, $data)
             ->assertSessionHasErrors(['text']);
    }

    /** @test */
    public function destroy()
    {
        $user     = factory(\App\Models\User::class)->create();
        $category = factory(\App\Models\Category::class)->create();

        $this->actingAs($user)
             ->delete('/admin/categories/' . $category->id);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
