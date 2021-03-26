@extends('home')

@section('content')
    
<h2 class="mb-4">Messages</h2>

@if (session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@endif

<div class="col-md-10">

    @if ($messages->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">title</th>
                    <th scope="col">Message</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->title }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $messages->links() }}
    @endif
</div>


@endsection