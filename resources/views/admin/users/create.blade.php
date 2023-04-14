@extends('home')

@section('content')

    <h2>Create User</h2>

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

        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="form-group">
                {{-- <label for="name">Username</label> --}}
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter a name" autocomplete="off">
            </div>
            <div class="form-group">
                {{-- <label for="post_title">Email</label> --}}
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter a valid email" autocomplete="off">
            </div>
            <div class="form-group">
                {{-- <label for="password">Password</label> --}}
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter a password">
            </div>
            <div class="form-group">
                {{-- <label for="password_confirmation">Confirm Password</label> --}}
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>

    </div>

@endsection

