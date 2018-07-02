<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Psy\Exception\FatalErrorException;

class DocMenuControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_needs_to_get_menu_from_the_givem_version()
    {
        $this->withoutExceptionHandling();
        $category = factory(\App\Models\Category::class)->create(['text' => 'Category']);
        factory(\App\Models\Documentation::class)->create([
            'category_id' => $category->id,
            'version'     => DEFAULT_VERSION,
            'title'       => 'Example'
        ]);

        $this->json('GET', '/menu/' . DEFAULT_VERSION . '/example')
            ->assertJson([
                'Category' => [
                    'title' => 'Category',
                    'items' => [
                        [
                            'title'    => 'Example',
                            'href'     => '/' . DEFAULT_VERSION . '/example',
                            'isActive' => true
                        ]
                    ],
                    'isActive' => true
                ]
            ]);
    }
}
