<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DocumentationsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function store()
    {
        $user = factory(\App\Models\User::class)->create();
        
        $data = [
            'title'         => 'Title',
            'category_id'   => 1,
            'documentation' => '
# Header

Lorem ipsum'
        ];

        $this->actingAs($user)
             ->post('/admin/docs', $data);

        $this->assertDatabaseHas('documentations', ['title' => 'Title']);
    }

    /** @test */
    public function update()
    {
        $user = factory(\App\Models\User::class)->create();
        $doc  = factory(\App\Models\Documentation::class)->create();

        $doc->title = "updated";

        $this->actingAs($user)
             ->put('/admin/docs/' . $doc->id, $doc->toArray());

        $this->assertDatabaseHas('documentations', ['title' => 'updated']);
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
