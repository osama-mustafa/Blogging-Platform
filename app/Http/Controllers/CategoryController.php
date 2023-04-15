<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function construct()
    {
        $this->middleware(['auth', 'admin']);
    }


    // View All Categories

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with([
            'categories' => $categories
        ]);
    }


    // Create Category

    public function create()
    {
        return view('admin.categories.create');
    }


    // Store Category
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100|'
        ]);

        $category                = new Category;
        $category->name = $request->name; 
        $category->save();
        return back()->with([
            'success_message' => 'Category has been created successfully'
        ]);
    }


    // Edit Category

    public function edit($id)
    {
        $category = Category::findorFail($id);
        return view('admin.categories.edit')->with([
            'category' => $category
        ]);
    }


    // Update Category
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|min:2|max:100'
        ]);
    
        $category = Category::findorFail($id);
        $category->category_name = $request->category_name;
        $category->save();
        return back()->with([
            'success_message' => 'Category has been updated'
        ]);

    }

    // Delete Category

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return back()->with([
            'success_message' => 'Category has been deleted'
        ]);
    }
}
