@include('includes.homepage-header')

<body>

    {{-- HomePage Navbar --}}

        @include('includes.homepage-nav')
    
    {{--End of HomePage Navbar --}}

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="pt-5">{{ $post->title }}</h1>

        <!-- Author -->

        <hr>

        {{-- Date/Time/Author --}}
        <p class="lead">
         Posted by: <i class="fas fa-user" style="color: grey"></i>
            <a href="{{ route('author.page', ['user_name' => $post->user->name]) }}" class="mr-2">{{ $post->user->name }}</a>
            <span class="mr-2">
                <i class="fas fa-clock ml-2" style="color: grey"></i> {{ $post->created_at->diffForHumans() }}
            </span>
            @if($postCategory)
                <span>
                    <i class="fas fa-folder mr-1" style="color: grey"></i>  
                    <a href="{{ route('category.page', [$postCategory->name]) }}">{{ $postCategory->name }}</a> 
                </span>
            @endif
        </p>
  
        <hr>

        <!-- Preview Image -->
        @if ($post->image)
            <img class="img-fluid rounded" src="{{ asset('/img') }}/{{$post->post_image}}" alt="">
        @else
            <img class="img-fluid rounded" src="{{ asset('/img/post.png') }}" alt="">
        @endif

        <hr>

        <!-- Post Content -->

        <p>{!! $post->body !!}</p>
        @auth
            @if (auth()->user()->is_admin)
                <div>
                    <a href="{{ route('posts.edit', ['post_id' => $post->id]) }}" class="btn btn-primary">Edit</a>
                </div>
            @endif
        @endauth

        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
            @if (session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <form action="{{ route('comments.store', ['post_id' => $post->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="body">Comment</label>
                      <textarea name="body" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- Single Comment -->

        <div>
            @if ($comments->count() > 0)
            <h4>Comments</h4>
            <hr>
                @foreach ($comments as $comment)
                    <div class="media mb-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                        <div class="media-body">
                            {{ $comment->body }} <br>
                            <small>sent at: {{ $comment->created_at }}</small>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

      </div>

      <!-- Sidebar Widgets Column -->
        @include('includes.homepage-sidebar')

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

    {{-- Footer --}}

    @include('includes.homepage-footer')

    {{-- End of Footer  --}}

  {{-- Bootstrap core JavaScript --}}
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
