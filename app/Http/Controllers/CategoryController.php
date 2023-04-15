<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with([
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }
    
    public function store(CategoryRequest $request)
    {
        $validatedData = $request->validated();
        Category::create($validatedData);
        return back()->with([
            'success_message' => 'Category has been created successfully'
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with([
            'category' => $category
        ]);
    }
    
    public function update(CategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();
        $category->name = $validatedData['name'];
        $category->save();
        return back()->with([
            'success_message' => 'Category has been updated'
        ]);

    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with([
            'success_message' => 'Category has been deleted'
        ]);
    }
}
