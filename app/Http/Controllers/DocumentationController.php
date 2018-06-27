<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Documentation;

class DocumentationController extends Controller
{
    public function show($version, $page = '')
    {
        if (! in_array($version, Documentation::versions())) {
            return redirect('docs/' . DEFAULT_VERSION . '/' . $version);
        }
        
        try {
            return view('docs', [
                'content' => Documentation::get($version, $page)
            ]);
        } catch (\Exception $e) {
            abort(404, 'The documentation page was not found!');
        }
    }
}
