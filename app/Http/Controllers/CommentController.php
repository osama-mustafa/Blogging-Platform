<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{


    // Show All Comments in Admin Dashboard

    public function index()
    {
        $comments = Comment::orderBy('created_at', 'DESC')->paginate(12);
        return view('admin.comments.index')->with([
            'comments' => $comments
        ]);
    }


    // Store Comments Coming From Visitors

    public function store(Request $request)
    {
        $post_id = $request->route('post_id');

        $request->validate([
            'comment_body' => 'required'
        ]);

        $sanitizedComment = filter_var($request->comment_body, FILTER_SANITIZE_STRING);

        $comment = new Comment;
        $comment->comment_body = $sanitizedComment;
        $comment->post_id      = $post_id;

        $comment->save();
        return back()->with([
            'success_message' => 'Comment has been sent and waiting for approval!'
        ]);

    }


    // Approve Pending Comments

    public function approveComment($id)
    {
        $comment                 = Comment::findOrFail($id);
        $comment->comment_status = true;
        $comment->save();
        return back()->with([
            'success_message' => 'Comment has been approved!'
        ]);
    }


    // Disapprove Comments

    public function disapproveComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->comment_status = false;
        $comment->save();
        return back()->with([
            'success_message' => 'Comment has been disapproved!'
        ]);
    }

    // Delete Comment (Delete Forever!)

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back()->with([
            'success_message' => 'Comment has been deleted!'
        ]);

    }
}
