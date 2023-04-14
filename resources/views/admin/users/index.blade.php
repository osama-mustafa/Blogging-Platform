@extends('home')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mb-4">Users</h2>
        </div>
        <div class="col">
           <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-left" role="button"> <i class="fas fa-user-plus"></i> Create</a>
        </div>
    </div>
</div>

@if (session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@endif

<div class="col-md-10">

    @if ($users->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Edit User</th>
                    <th scope="col">Admin Status</th>
                    <th scope="col">No. of Posts</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                        <td>
                            @if ($user->is_admin == true)
                                <a class="btn btn-primary btn-sm" href="{{ route('remove.admin', ['user_id' => $user->id]) }}"><i class="fas fa-lock"></i> Remove Admin</a>
                            @endif

                            @if ($user->is_admin == false)
                                <a class="btn btn-primary btn-sm" href="{{ route('make.admin', ['user_id' => $user->id]) }}"><i class="fas fa-unlock"></i> Make Admin</a>
                            @endif
                        </td>
                        <td>{{ $user->posts->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    @endif

</div>


@endsection