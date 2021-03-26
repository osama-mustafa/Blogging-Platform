<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Tag;



class HomepageController extends Controller
{

    // Website HomePage

    public function homepage()
    {
        $posts      = Post::orderBy('created_at', 'DESC')->paginate(4);
        $categories = Category::limit(4)->get();
        $tags       = Tag::limit(6)->get();

        return view('index')->with([
            'posts'      => $posts,
            'categories' => $categories,
            'tags'       => $tags
        ]);
    }

    // Show Single Post Page

    public function singlePost($id, $post_slug)
    {
        $post            = Post::findOrFail($id);
        $post_slug       = $post->post_slug;
        $categories      = Category::limit(4)->get();
        $tags            = Tag::limit(6)->get();
        $postCategory    = Post::find($id)->categories()->first(); 
        $comments        = Comment::where('comment_status', true)->where('post_id', $id)->get();

        return view('post')->with([
            'post'         => $post,
            'post_Slug'    => $post_slug,
            'comments'     => $comments,
            'categories'   => $categories,
            'postCategory' => $postCategory,
            'tags'         => $tags
        ]);
    }

    // Search Engine in Homepage

    public function searchEngine(Request $request)
    {
        $categories = Category::limit(4)->get();
        $tags       = Tag::limit(6)->get();
        $search     = filter_var(trim($request->get('search')), FILTER_SANITIZE_STRING) ;

        $posts = Post::where('post_title', 'LIKE', "%{$search}%")->orderBy('created_at', 'DESC')->paginate(4);
        return view('search')->with([
            'posts'      => $posts,
            'categories' => $categories,
            'search'     => $search,
            'tags'       => $tags
        ]);
    }


    // About Us Page
    
    public function about()
    {
        $categories = Category::limit(4)->get();
        $tags       = Tag::limit(6)->get();

        return view('about')->with([
            'categories' => $categories,
            'tags'       => $tags
        ]);
    }

  
    // Category Page

    public function categoryPage($category_name)
    {
        $categories      = Category::limit(4)->get();
        $tags            = Tag::limit(6)->get();
        $category        = Category::where('category_name', $category_name)->firstOrFail();
        $categoryPosts   = $category->posts()->paginate(4);

        return view('category')->with([
            'categories'    => $categories,
            'category'      => $category,
            'categoryPosts' => $categoryPosts,
            'tags'          => $tags
        ]);
    }
    

    // Author Page

    public function authorPage($user_name)
    {
        $categories  = Category::limit(4)->get();
        $tags        = Tag::limit(6)->get();
        $user        = User::where('name', $user_name)->firstOrFail();
        $authorPosts = $user->posts()->paginate(4);

        return view('author')->with([

            'categories'  => $categories,
            'user'        => $user,
            'authorPosts' => $authorPosts,
            'tags'        => $tags
        ]);
    }

    Public function tagPage($tag_name)
    {
        $categories = Category::limit(4)->get();
        $tags       = Tag::limit(6)->get();
        $tag        = Tag::where('tag_name', $tag_name)->firstOrFail();
        $tagPosts   = $tag->posts()->paginate(4);

        return view('tag')->with([

            'tag'           => $tag,
            'tags'          => $tags,
            'categories'    => $categories,
            'tagPosts'      => $tagPosts
        ]);
    }

}
