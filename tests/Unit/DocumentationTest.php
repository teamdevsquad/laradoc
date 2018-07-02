<?php

namespace Tests\Unit;

use File;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DocumentationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_gets_the_documentation_page_for_a_given_version()
    {
        factory(\App\Models\Documentation::class)
            ->create([
                'title'         => 'Example',
                'documentation' => '# Example Page for 1.0'
            ]);
            
        $content = (new \App\Documentation)->get('1.0', 'example');
        
        $this->assertEquals('<h1>Example Page for 1.0</h1>', $content);
    }

    /** @test */
    public function it_parses_with_a_class_included()
    {
        factory(\App\Models\Documentation::class)
            ->create([
                'title'         => 'Example',
                'documentation' => '# Example Page for {{version}} {.sth}'
            ]);

        $content = (new \App\Documentation)->get('1.0', 'example');
        
        $this->assertEquals('<h1 class="sth">Example Page for 1.0</h1>', $content);
    }

    /** @test */
    public function it_thrown_an_exepception_if_the_requested_markdown_file_does_not_exists()
    {
        $this->expectException(\Exception::class);

        (new \App\Documentation)->get('1.0', 'example');
    }
}

