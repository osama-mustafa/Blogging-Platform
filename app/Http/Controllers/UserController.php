<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(8);
        return view('admin.users.index')->with([
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make(trim($request->password));
        User::create($validatedData);
        return back()->with([
            'success_message' => 'User has been created'
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit')->with([
            'user' => $user
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $validatedData  = $request->validated();
        $user->name     = $validatedData['name'];
        $user->email    = $validatedData['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make(trim($request->password));
        }

        $user->save();
        return back()->with([
            'success_message' => 'User has been updated'
        ]);
    }

    public function makeAdmin($id)
    {
        $user           = User::findOrFail($id);
        $user->is_admin = true;
        $user->save();
        return back()->with([
            'success_message' => 'User is added to admins'
        ]);
    }
    
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
