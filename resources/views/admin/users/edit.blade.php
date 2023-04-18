@extends('home')

@section('content')

    <h2>Edit User</h2>

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    <!-- Error Component -->
    <x-messages.error />

    <div class="col-8">

        <form method="POST" action="{{ route('users.update', ['user' => $user]) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>  

            <!-- Profile image -->
            <x-images.avatar :user="$user" />

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>

    </div>

@endsection

