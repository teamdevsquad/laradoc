<?php

namespace App;

use File;
use ParsedownExtra;
use App\Exceptions\DocumentationException;
use App\Models\Documentation as Doc;

class Documentation
{
    public function get($version, $page)
    {
        $doc = Doc::where('slug', $page)->where('version', $version)->first();
        if ( $doc ) {
            return $this->replaceLinks(
                $version,
                (new ParsedownExtra)->text($doc->documentation)
            );
        }
        
        throw new DocumentationException('The requested documentation page was not found');
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
