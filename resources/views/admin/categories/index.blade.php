@extends('home')

@section('content')
    
    <h2>Create Category</h2>

    <x-messages.error />

    <div class="col-md-5 mb-4">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="ex. php, laravel, HTML">
            </div>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create</button>
        </form>    
    </div>


@if (session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@endif

<div class="col-md-10">

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
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', ['category' => $category]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy', ['category' => $category]) }}" method="POST">
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


@endsection