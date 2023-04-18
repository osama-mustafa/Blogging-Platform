@extends('home')

@section('content')
    
    <h2 class="mb-4">Tags</h2>
    <hr>
    
    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    <!-- Error Component -->
    <x-messages.error />



<div class="col-md-10">

    <div class="col-md-5 mb-4">
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf 
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="ex. php, laravel, HTML">
            </div>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create</button>
        </form>    
    </div>

    @if ($tags->count() > 0)
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <a href="{{ route('tags.edit', ['tag' => $tag]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('tags.destroy', ['tag' => $tag]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-trash"></i> Delete</button>
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