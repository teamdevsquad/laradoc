<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocumentationService;
use App\Http\Requests\DocumentationRequest;
use App\Models\Documentation;

class DocumentationsController extends Controller
{
    private $service;

    public function __construct(DocumentationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(DocumentationRequest $request)
    {
        $this->service->create($request->form());    
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
    }

    public function destroy(Documentation $doc)
    {
        $this->service->delete($doc);
    }
}
