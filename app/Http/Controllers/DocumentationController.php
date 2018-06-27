<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Documentation;
use App\Exceptions\DocumentationException;

class DocumentationController extends Controller
{
    public function show($version, $page = '')
    {
        if (! in_array($version, Documentation::versions())) {
            return redirect('/' . DEFAULT_VERSION . '/' . $version);
        }
        
        try {
            return view('docs', [
                'content' => Documentation::get($version, $page),
                'page'    => $page
            ]);
        } catch (DocumentationException $e) {
            abort(404, 'The documentation page was not found!');
        }
    }
}
