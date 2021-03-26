<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\Message;
use Illuminate\Contracts\Mail\Mailable;


class EmailController extends Controller
{


    // Show The Contact Form

    public function index()
    {
        $categories = Category::limit(4)->get();
        return view('contact.contact-form')->with([
            'categories' => $categories
        ]);
    }

    // Send Email & Store Message Details in Database

    public function sendEmail(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|min:3|max:50',
            'email'      => 'required|email',
            'title'      => 'required|string',
            'message'    => 'required|string|max:300'
        ]);

        $sanitizedName    = filter_var($request->name, FILTER_SANITIZE_STRING);
        $saniztizedEmail  = filter_var($request->email, FILTER_SANITIZE_EMAIL);
        $sanitizedTitle   = filter_var($request->title, FILTER_SANITIZE_STRING);
        $sanitizedMessage = filter_var($request->message, FILTER_SANITIZE_STRING);

        $data = array(
            'name'      => $sanitizedName,
            'email'     => $saniztizedEmail,
            'title'     => $sanitizedTitle,
            'message'   => $sanitizedMessage
        );

        Message::create([
            'name'      => $sanitizedName,
            'email'     => $saniztizedEmail,
            'title'     => $sanitizedTitle,
            'message'   => $sanitizedMessage
        ]);

        Mail::to('youremail@example.com')->send(new SendEmail($data));
        return back()->with([
            'success_message' => 'Thanks For contacting Us!'
        ]);
    }
}
