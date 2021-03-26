<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    // Edit Your Own Profile

    public function editProfile()
    {
        $user = auth()->user();
        return view('profile.edit-profile')->with([
            'user' => $user
        ]);
    }

    
    // Update Your Own Profile

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'  => 'required|min:4|max:100',
            'email' => [
                'required',
                Rule::unique('users')->ignore(auth()->id())
            ]
        ]);

        $id = auth()->id();

        $user        = User::where('id', $id)->first();
        $user->name  = $request->name;
        $user->email = $request->email;

        // Update Password

        if (!empty($request->password))
        {
            $user->password = bcrypt($request->password) ;
        }

        // Update Short Biography

        if (!empty($request->short_bio))
        {
            $request->validate([
                'short_bio' => 'string|max:250'
            ]);

            $user->short_bio = $request->short_bio;
        }

        // Upload Profile Image

        if (!empty($request->profile_image))
        {
            $request->validate([
                'profile_image' => 'required|image|mimes:jpg,jpeg,png,bmp'
            ]);

            $image_name          = $request->profile_image->getClientOriginalName();
            $image_new_name      = time() . $image_name;
            $request->profile_image->move(public_path('img'), $image_new_name);
            $user->profile_image = $image_new_name; 
        }

        $user->save();
        return back()->with([
            'success_message' => 'Your profile hsa been updated successfully!'
        ]);  

    }
    
}
