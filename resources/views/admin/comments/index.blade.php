@extends('home')

@section('content')
    
<h2 class="mb-4">Comments</h2>

@if (session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@endif

<div class="col-md-10">

    @if ($comments->count() > 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Comment</th>
                <th scope="col">Sent at</th>
                <th scope="col">Status</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->created_at }}</td>
                        <td>
                            @if ($comment->status == false)
                                <a class="btn btn-primary btn-sm" href="{{ route('approve.comment', ['comment_id' => $comment->id]) }}"><i class="fas fa-thumbs-up"></i> Approve</a>
                            @endif

                            @if ($comment->status == true)
                                <a class="btn btn-primary btn-sm" href="{{ route('disapprove.comment', ['comment_id' => $comment->id]) }}"><i class="fas fa-thumbs-down"></i> Disapporve</a>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('delete.comment', ['comment_id' => $comment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $comments->links() }}
    @else 
        <p>There is no comments!</p>
    @endif

</div>


@endsection