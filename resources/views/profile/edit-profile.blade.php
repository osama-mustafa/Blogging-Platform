@extends('home')

@section('content')

    <h2>Edit Profile</h2>

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
                <label for="biography">Short Biography</label>
                <input type="text" class="form-control" name="biography" id="short_bio" value="{{ $user->biography }}">
            </div>
            <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" name="image">
            </div>

            <!-- Profile image -->
                @if($user->image)
                    <x-images.avatar
                    :src='asset("storage/images/{$user->image}")'
                    :width='200'
                    :height='200'
                    :class="'rounded'"
                    />
                @else 
                    <x-images.avatar
                    :src='asset("img/profile.png")'
                    :width='200'
                    :height='200'
                    :class="'rounded'"
                    />
                @endif

            <div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>

    </div>

@endsection

