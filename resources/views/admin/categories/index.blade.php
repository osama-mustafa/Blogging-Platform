@extends('home')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mb-4">Categories</h2>
        </div>
        <div class="col">
           <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-left" role="button"> <i class="fas fa-layer-group"></i> Create</a>
        </div>
    </div>
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
                        <a href="{{ route('categories.edit', ['category_id' => $category->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('categories.delete', ['category_id' => $category->id]) }}" method="POST">
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