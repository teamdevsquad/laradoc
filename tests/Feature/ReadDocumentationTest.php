<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadDocumentationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_assumes_the_latest_documentation_version()
    {
        $this->get('/some-page')->assertRedirect('/' . DEFAULT_VERSION . '/some-page');
    }

    /** @test */
    public function it_loads_and_parsees_a_markdown_documentation_pages()
    {
        factory(\App\Models\Documentation::class)
            ->create([
                'title'         => 'Stub',
                'version'       => DEFAULT_VERSION,
                'documentation' => '# Stub

Paragraph'
            ]);

        $this->get('/'.DEFAULT_VERSION.'/stub')
            ->assertSee('<h1>Stub</h1>')
            ->assertSee('<p>Paragraph</p>');
    }

    /** @test */
    public function it_aborts_if_the_requested_documentation_page_is_not_fonud()
    {
        $this->get('/'.DEFAULT_VERSION.'/does-not-exists')->assertNotFound();
    }
}
