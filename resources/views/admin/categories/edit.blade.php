@extends('home')

@section('content')

    <h2>Edit Category</h2>

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <ul>
                    <li>
                        {{ $error }}
                    </li>
                </ul>
            </div>
        @endforeach
    @endif

    <div class="col-10">

        <form method="POST" action="{{ route('categories.update', ['category_id' => $category->id]) }}">
            @csrf
            <div class="form-group">
                <label for="category_name">Category</label>
                <input type="text" class="form-control" name="category_name" id="category_name" value="{{ $category->category_name }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>

@endsection

