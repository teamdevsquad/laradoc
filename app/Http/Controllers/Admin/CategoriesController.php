<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    private $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = Category::search( request('search') )->paginate( 15 );
        return view( 'category.index', compact( 'categories' ) );
    }

    public function create()
    {
        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->service->create($request->form());
        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('category.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->service->update($request->form(), $category);
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $this->service->delete($category);
        return redirect()->route('categories.index');
    }
}
