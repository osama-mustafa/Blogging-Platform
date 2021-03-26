<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }


    // Show All Users

    public function index()
    {
        $users = User::paginate(4);
        return view('admin.users.index')->with([
            'users' => $users
        ]);
    }

    // Create User

    public function create()
    {
        return view('admin.users.create');
    }


    // Store User

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|min:4|max:100',
            'email'     => 'required|unique:users|email',
            'password'  => 'required|confirmed'
        ]);

        $user           = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
        return back()->with([
            'success_message' => 'User has been created'
        ]);
    }


    // Edit User By Admin

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit')->with([
            'user' => $user
        ]);
    }


    // Update User By Admin

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([

            'name' => 'required|min:4|max:100',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id)
            ]
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        if (!empty($request->password))
        {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return back()->with([
            'success_message' => 'User has been updated'
        ]);

    }


    // Make User as Admin

    public function makeAdmin($id)
    {
        $user           = User::findOrFail($id);
        $user->is_admin = true;
        $user->save();
        return back()->with([
            'success_message' => 'User is added to admins'
        ]);
    }
    

    // Remove User from Admins

    public function removeAdmin($id)
    {
        $user           = User::findOrFail($id);
        $user->is_Admin = false;
        $user->save();
        return back()->with([
            'success_message' => 'User is removed from admins'
        ]);
    }

}
