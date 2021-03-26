<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    // Show All Tags in Admin Dashboard

    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index')->with([
            'tags' => $tags
        ]);
    }

    // Create Tag

    public function create()
    {
        return view('admin.tags.index');
    }

    // Store Tag

    public function store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required|min:2|max:30|string'
        ]);

        Tag::create([
            'tag_name' => $request->tag_name,
        ]);

        return back()->with([
            'success_message' => 'Tag has been created!'
        ]);
    }

    // Delete Tag (Delete Forever!)

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return back()->with([
            'success_message' => 'Tag has been deleted!'
        ]);
    }
}
