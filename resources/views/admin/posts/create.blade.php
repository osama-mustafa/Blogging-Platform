@extends('home')

@section('content')

    <h2>Create Post</h2>

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    <!-- Error Component -->
    <x-messages.error />


    <div class="col-10">

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="post_title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Post Title">
            </div>
            <div class="form-group">
                <label for="post_body">Content</label>
                <x-forms.tinymce-editor name="body" value=""/>
            </div>

            <h5 class="mt-3">Categories</h5>

            @foreach ($categories as $category)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                    </label class="custom-control-label">{{ $category->name }}<label>
                </div>
            @endforeach

            <h5 class="mt-3">Tags</h5>
            
            @foreach ($tags as $tag)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                    <label>{{ $tag->name }}</label>
                </div>
            @endforeach

            <div class="form-group mt-2">
                <label for="image">Image</label><br>
                <input type="file" name="image" id="post_image">
            </div>
            <button type="submit" class="btn btn-primary">Publish Post</button>
        </form>

    </div>

    

@endsection

