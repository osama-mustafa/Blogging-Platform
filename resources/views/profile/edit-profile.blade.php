@extends('home')

@section('content')

    <h2>Edit Your Profile</h2>

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <ul>
                    <li>
                        {{ $error }}
                    </li>
                </ul>
            </div>
        @endforeach
    @endif

    <div class="col-10">

        <form method="POST" action="{{ route('update.profile') }}" enctype="multipart/form-data">
            @csrf
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
            <div class="form-group">
                <label for="short_bio">Short Biography</label>
                <input type="text" class="form-control" name="short_bio" id="short_bio" value="{{ $user->short_bio }}">
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" name="profile_image">
            </div>

            @if (auth()->user()->profile_image == null)
                <div>
                    <img class="img-profile mb-2" width="200" src="{{ asset('img/undraw_profile.svg') }}">
                </div>
            @else 
                <div>
                    <img class="img-profile mb-2" width="200" src="{{ asset('/img') }}/{{$user->profile_image}}">
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>

    </div>

@endsection

