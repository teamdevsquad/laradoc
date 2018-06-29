<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\DocumentationService;
use App\Http\Requests\DocumentationRequest;
use App\Models\Documentation;
use App\Models\Category;
use App\Http\Controllers\Controller;

class DocumentationController extends Controller
{
    private $service;

    public function __construct(DocumentationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $docs = Documentation::search( request('search') )->paginate( 15 );
        return view( 'documentation.index', compact( 'docs' ) );
    }

    public function create()
    {
        $categories = Category::all();
        return view('documentation.create', compact('categories'));
    }

    public function store(DocumentationRequest $request)
    {
        $this->service->create($request->form());
        return redirect()->route('docs.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(DocumentationRequest $request, Documentation $doc)
    {
        $this->service->update($request->form(), $doc);
        return redirect()->route('docs.index');
    }

    public function destroy(Documentation $doc)
    {
        $this->service->delete($doc);
        return redirect()->route('docs.index');
    }
}
