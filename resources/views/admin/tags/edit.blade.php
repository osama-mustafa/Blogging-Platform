@extends('home')

@section('content')

    <h2>Edit Tag</h2>

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    <!-- Error Component -->
    <x-messages.error />


    <div class="col-10">
        <form method="POST" action="{{ route('tags.update', ['tag' => $tag]) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <input type="text" class="form-control" name="name" value="{{ $tag->name }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

