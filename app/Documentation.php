<?php

namespace App;

use Exception;
use File;
use ParsedownExtra;

class Documentation
{
    public function get($version, $page)
    {
        if ( File::exists($page = $this->markdownPath($version, $page)) ) {
            return $this->replaceLinks(
                $version,
                (new ParsedownExtra)->text(File::get($page))
            );
        }
        
        throw new Exception('The requested documentation page was not found');
    }

    public function markdownPath($version, $page)
    {
        return resource_path('docs/'.$version.'/'.$page.'.md');
    }

    public static function versions()
    {
        return [1.0];
    }

    public function replaceLinks($version, $content)
    {
        return str_replace('{{version}}', $version, str_replace('{{ version }}', $version, $content));
    }
}
