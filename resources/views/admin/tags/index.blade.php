@extends('home')

@section('content')
    
<h2 class="mb-4">Tags</h2>
<hr>
@if (session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@endif

<div class="col-md-10">

    <div class="col-md-5 mb-4">
        <h3>Create Tag</h3>
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf 
            @method('POST')
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="ex. php, laravel, HTML">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>    
    </div>

    @if ($tags->count() > 0)
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <form action="{{ route('tags.delete', ['tag_id' => $tag->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    </div>
    @else 
        <h4>There is no tags!</h4>
    @endif

</div>


@endsection