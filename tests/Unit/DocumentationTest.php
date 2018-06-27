<?php

namespace Tests\Unit;

use File;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentationTest extends TestCase
{
    /** @test */
    public function it_gets_the_documentation_page_for_a_given_version()
    {
        File::shouldReceive('exists')
            ->once()
            ->with(resource_path('docs/1.0/example.md'))
            ->andReturn(true);
            
        File::shouldReceive('get')
            ->once()
            ->with(resource_path('docs/1.0/example.md'))
            ->andReturn('# Example Page for {{version}}');
            
        $content = (new \App\Documentation)->get('1.0', 'example');
        
        $this->assertEquals('<h1>Example Page for 1.0</h1>', $content);
    }

    /** @test */
    public function it_thrown_an_exepception_if_the_requested_markdown_file_does_not_exists()
    {
        $this->expectException(\Exception::class);

        (new \App\Documentation)->get('1.0', 'example');
    }
}

