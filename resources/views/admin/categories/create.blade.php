@extends('home')

@section('content')

    <h2>Create Category</h2>

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    <!-- Error Component -->
    <x-messages.error />

    <div class="col-10">

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="ex. PHP or Laravel">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>

    </div>

@endsection

