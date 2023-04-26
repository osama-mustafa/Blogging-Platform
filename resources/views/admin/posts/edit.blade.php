@extends('home')

@section('content')

    <h2>Edit Post</h2>

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    <!-- Error Component -->
    <x-messages.error />


    <div class="col-10">

        <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="post_title">Title</label>
              <input type="text" class="form-control" name="title" id="title" value="{{ $post->title }}">
            </div>
            <div class="form-group">
              <label for="post_body">Content</label>
              <!-- <textarea class="form-control" name="post_body" id="post_body" rows="3">{{ $post->post_body }}</textarea> -->
              <x-forms.tinymce-editor name="body" value="{{ $post->body }}"/>

            </div>

            {{-- Categories & Tags --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Categories</h5>
                        @foreach ($categories as $category)
                            <div class="checkbox">
                                <input type="checkbox" name="categories[]" id="{{ $category->name }}"
                                value="{{ $category->id }}" {{ in_array($category->id, $postCategories) ? 'checked' : '' }}>
                                <label for="{{ $category->name }}">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-md-6">
                        <h5 class="mt-2">Tags</h5>
                        @foreach ($tags as $tag)
                            <div class="checkbox">
                                <input type="checkbox" value="{{ $tag->id }}" name="tags[]"  {{ in_array($tag->id, $postTags) ? 'checked' : '' }}>
                                <label for="">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Post image -->
                        @if ($post->image)
                            <x-images.avatar 
                                :src='asset("storage/images/{$post->image}")' 
                                :height="200"
                                :width="200"
                                :class="'rounded'"
                            />
                        @else
                            <x-images.avatar 
                                :src='asset("img/post.png")' 
                                :height="200"
                                :width="200"
                                :class="'rounded'"
                            />
                        @endif

            <div class="form-group">
                <label for="post_image">Image</label><br>
                <input type="file" name="post_image" id="post_image">
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>

        </form>

    </div>

@endsection





