<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     // Show The Settings in The Admin Dashboard

    public function index()
    {
        $posts      = Post::all();
        $users      = User::all();
        $comments   = Comment::all();
        $categories = Category::all();
        $messages   = Message::all();
        return view('layouts.dashboard')->with([

            'posts'      => $posts,
            'users'      => $users,
            'comments'   => $comments,
            'categories' => $categories,
            'messages'   => $messages
            
        ]);
    }
}
