@extends('home')

@section('content')

    <h2 class="mb-4">Message Details</h2>
    <div class="col-10">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">{{ $message->title }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Name</th>
                    <td>{{ $message->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>{{ $message->email }}</td>
                </tr>
                <tr>
                    <th scope="row">Body</th>
                    <td>{{ $message->body }}</td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection





