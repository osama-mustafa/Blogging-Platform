@extends('home')

@section('content')
    
<h2 class="mb-4">Posts</h2>

<div class="col-md-10">

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if ($posts->count() > 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Author</th>
                <th scope="col">Edit Post</th>
                <th scope="col">Delete Post</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>
                           <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->post_slug]) }}">
                                {{ $post->post_title }}
                            </a> 
                        </td>
                        <td>
                            <img src="{{ asset('img/') }}/{{$post->post_image}}" class="img-thumbnail" width="100" alt="">
                        </td>
                        <td>
                            <a href="{{ route('author.page', ['user_name' => $post->user->name]) }}">{{ $post->user->name }}</a>
                            
                        </td>
                        <td>
                            <a href="{{ route('posts.edit', ['post_id' => $post->id]) }}" class="btn btn-primary"><i class="far fa-edit"></i> Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('posts.delete', ['post_id' => $post->id]) }}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $posts->links() }}

    @else 
        <p>There is no posts!</p>
    @endif

</div>

@endsection