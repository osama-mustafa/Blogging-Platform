<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

   
    // Show All Messages From Contact Form in Admin Dashboard
    
    public function index()
    {
        $messages = Message::paginate(4);
        return view ('admin.messages.index')->with([
            'messages' => $messages
        ]);
    }

}
