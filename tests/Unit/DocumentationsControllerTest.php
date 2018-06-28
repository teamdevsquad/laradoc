<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;
use Psy\Exception\FatalErrorException;
use App\Models\Documentation;
use App\Models\User;

class DocumentationsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_needs_to_be_protected_for_non_users()
    {
        $this->get('/admin/docs')->assertStatus(302);
        $this->post('/admin/docs')->assertStatus(302);
        $this->put('/admin/docs/1')->assertStatus(302);
        $this->delete('/admin/docs/1')->assertStatus(302);
    }

    /** @test */
    public function store()
    {
        $this->withExceptionHandling();
        $user     = factory(\App\Models\User::class)->create();
        $category = factory(Category::class)->create();
        $data     = [
            'title'         => 'Title',
            'category_id'   => $category->id,
            'documentation' => '# Header\n\nLorem ipsum'
        ];

        $this->actingAs($user)
             ->post('/admin/docs', $data);

        $this->assertDatabaseHas('documentations', [
            'title'         => 'Title',
            'category_id'   => $category->id,
            'slug'          => str_slug('Title'),
            'documentation' => '# Header\n\nLorem ipsum'
        ]);
    }

    /** @test */
    public function it_should_validate_required_fields_on_create()
    {
        $user     = factory(\App\Models\User::class)->create();
        $data     = [];

        $this->actingAs($user)
             ->post('/admin/docs', $data)
             ->assertSessionHasErrors(['title', 'documentation']);
    }

    /** @test */
    public function update()
    {
        $user = factory(\App\Models\User::class)->create();
        $doc  = factory(\App\Models\Documentation::class)->create();

        $doc->title = "updated";

        $this->actingAs($user)
             ->put('/admin/docs/' . $doc->id, $doc->toArray());

        $this->assertDatabaseHas('documentations', [
            'title' => 'updated',
            'slug'  => 'updated'
        ]);
    }

    /** @test */
    public function it_should_validate_required_fields_on_update()
    {
        $user = factory(\App\Models\User::class)->create();
        $doc  = factory(\App\Models\Documentation::class)->create();
        $data = [];
        $this->actingAs($user)
             ->put('/admin/docs/' . $doc->id, $data)
             ->assertSessionHasErrors(['title', 'documentation']);
    }

    /** @test */
    public function destroy()
    {
        $this->withoutExceptionHandling();
        $user = factory(\App\Models\User::class)->create();
        $doc  = factory(\App\Models\Documentation::class)->create();

        $this->actingAs($user)
             ->delete('/admin/docs/' . $doc->id);

        $this->assertDatabaseMissing('documentations', ['id' => $doc->id]);
    }
}
