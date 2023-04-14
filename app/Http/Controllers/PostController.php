<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    // View All Posts In Dashboard

    public function index() 
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(4);
        return view('admin.posts.index')->with([
            'posts' => $posts,
        ]);
    }


    // Create New Post

    public function create()
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.posts.create')->with([
            'categories' => $categories,
            'tags'       => $tags
        ]);
    }


    // Store Post

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'body'  => 'required|min:3',
            'image' => 'required|image|mimes:jpg,jpeg,png,bmp'
        ]);

        // Upload Image Post
        $image_old_name  = $request->post_image->getClientOriginalName();
        $image_new_name  = time() . $image_old_name;
        $request->post_image->move(public_path('img'), $image_new_name);

        $post = new Post;
        $post->post_title = $request->post_title;
        $post->post_body  = $request->post_body;
        $post->post_slug  = Str::slug($request->post_title);
        $post->user_id    = auth()->user()->id;
        $post->post_image = $image_new_name;
        $post->save();

        // Attach Categories to Post
        $post->categories()->sync($request->input('categories'));

        // Attach Tags to Post
        $post->tags()->sync($request->input('tags'));
        
        return back()->with([
            'success_message' => 'Post has been published!',
        ]);

    }


    // Edit Post

    public function edit($id)
    {
        $post           = Post::findOrFail($id);
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

    
    // Update Post

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

    // Delete Post (Soft Delete)

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return back()->with([

            'success_message' => 'Post has been deleted'
        ]);
    }


    // Show All Trashed Posts

    public function trashedPosts()
    {
        $posts = Post::onlyTrashed()->paginate(4);
        return view('admin.posts.trashed')->with([
            'posts' => $posts
        ]);
    }


    // Restore Trashed Posts

    public function restoreTrashed($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return back()->with([
            'success_message' => 'Post has been restored successfully!'
        ]);
    }
    

    // Delete Trashed Posts (DELETE FOREVER!)

    public function deleteTrashed($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
        return back()->with([
            'success_message' => 'Post has been deleted FOREVER!'
        ]);
    }

}
