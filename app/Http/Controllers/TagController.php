<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index')->with([
            'tags' => $tags
        ]);
    }

    public function create()
    {
        return view('admin.tags.index');
    }

    public function store(TagRequest $request)
    {
        $validatedData = $request->validated();
        Tag::create($validatedData);
        return back()->with([
            'success_message' => 'Tag has been created!'
        ]);
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit')->with([
            'tag' => $tag
        ]);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $validatedData = $request->validated();
        $tag->name = $validatedData['name'];
        $tag->save();
        return back()->with([
            'success_message' => 'Tag has been updated!'
        ]);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with([
            'success_message' => 'Tag has been deleted!'
        ]);
    }
}
