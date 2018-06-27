<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class ReadDocumentationTest extends TestCase
{
    /** @test */
    public function it_assumes_the_latest_documentation_version()
    {
        $this->get('/some-page')->assertRedirect('/docs/' . DEFAULT_VERSION . '/some-page');
    }

    /** @test */
    public function it_loads_and_parsees_a_markdown_documentation_pages()
    {
        app()->instance('App\Documentation', Mockery::mock('App\Documentation[markdownPath]', function ($mock) {
            $mock->shouldReceive('markdownPath')->once()->andReturn(
                base_path('tests/helpers/stubs/docs/1.0/stub.md')
            );
        }));

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
