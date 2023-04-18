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
                    <th scope="col">Title</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>                        
                            <a href="{{ route('messages.show', ['message' => $message]) }}">{{ $message->title }}</a>
                        </td>
                        <td>
                            <form action="{{ route('messages.destroy', ['message' => $message]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary btn-sm"> <i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $messages->links() }}
    @endif
</div>


@endsection