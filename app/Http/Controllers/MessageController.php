<?php

namespace App\Http\Controllers;

use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::paginate(8);
        return view ('admin.messages.index')->with([
            'messages' => $messages
        ]);
    }

    public function show(Message $message)
    {
        return view('admin.messages.show')->with([
            'message' => $message
        ]);
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return back()->with([
            'success_message' => 'Message has been deleted'
        ]);
    }
}
