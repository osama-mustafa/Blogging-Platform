<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use ImageUpload;
    public function index() 
    {
        $posts = Post::latest()->paginate(4);
        return view('admin.posts.index')->with([
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.posts.create')->with([
            'categories' => $categories,
            'tags'       => $tags
        ]);
    }
    public function store(PostRequest $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validated();
            if ($request->filled('image')) {
                $validatedData['image'] = $this->handleUploadImage($request);
            }
    
            $post = Post::create([
                'title'     => $validatedData['title'],
                'slug'      => Str::slug($validatedData['title']),
                'body'      => $validatedData['body'],
                'image'     => $validatedData['image'] ?? null,
                'user_id'   => Auth::id(),
            ]);
    
            $post->categories()->sync($request->input('categories'));
            $post->tags()->sync($request->input('tags'));

            DB::commit();
            return back()->with([
                'success_message' => 'Post has been published!',
            ]);
    
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    // Edit Post

    public function edit(Post $post)
    {
        $categories     = Category::all();
        $tags           = Tag::all();

        $postCategories = [];
        $postCategories = $post->categories->pluck('id')->toArray();

        $postTags       = [];
        $postTags       = $post->tags->pluck('id')->toArray();


        return view('admin.posts.edit')->with([
            'post'           => $post,
            'categories'     => $categories,
            'tags'           =>  $tags,
            'postCategories' => $postCategories,
            'postTags'       => $postTags
        ]); 

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'post_title'    => 'required|min:5|max:255',
            'post_body'     => 'required'
        ]);

        $post               = Post::findOrFail($id);
        $post->post_title   = $request->post_title;
        $post->post_body    = $request->post_body;
        $post->post_slug    = Str::slug($request->post_title);
        $post->categories()->sync($request->input('categories'));
        $post->tags()->sync($request->input('tags'));

        if ($request->has('post_image'))
        {
            $image_old_name     = $request->post_image->getClientOriginalName();
            $image_new_name     = time() . $image_old_name;
            $request->post_image->move(public_path('img'), $image_new_name);
            $post->post_image   = $image_new_name;
        }

        $post->save();
        return back()->with([
            'success_message' => 'Post has been updated'
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with([
            'success_message' => 'Post has been deleted'
        ]);
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(8);
        return view('admin.posts.trashed')->with([
            'posts' => $posts
        ]);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return back()->with([
            'success_message' => 'Post has been restored successfully!'
        ]);
    }

    public function deleteForever($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
        return back()->with([
            'success_message' => 'Post has been deleted FOREVER!'
        ]);
    }
}
