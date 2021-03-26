@include('includes.homepage-header')

<body>

    {{-- HomePage Navbar --}}

        @include('includes.homepage-nav')
    
    {{--End of HomePage Navbar --}}

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">{{ $tag->tag_name }}</h1>

        <!-- Blog Post -->
        @if ($tag->posts->count() > 0)
            @foreach ($tagPosts as $post)
            <hr>
                <div class="container mb-3">
                    <div class="card">
                        <div class="row">
                            <div class="col-md">
                                <img class="mt-2 mb-2 ml-2 img-fluid" src="{{ asset('/img') }}/{{$post->post_image}}" alt="Responsive image">
                            </div>
                            <div class="col-md mb-2">
                                <h3 class="mt-2">
                                    <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->post_slug]) }}">{{ $post->post_title }}</a>
                                </h3>
                                <p>{!! Str::words($post->post_body, 15, '...')  !!}</p>
                                <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->post_slug]) }}" class="btn btn-primary">Read More &rarr;</a>
                                <div class="mt-3 text-muted">
                                    <span>
                                        <i class="fas fa-user"></i>
                                        <a href="{{ route('author.page', ['user_name' => $post->user->name]) }}" class="mr-2">{{ $post->user->name }}</a>
                                    </span>
                                    <span>
                                        <i class="fas fa-clock text-secondary ml-2"></i> {{ $post->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            @endforeach
        @else 
            <h3>No Posts Found in this tag!!</h3>
        @endif

        {{ $tagPosts->links() }}


      </div>

      {{-- Sidebar Widgets Column --}}

      @include('includes.homepage-sidebar')


    </div>
    <!-- /.row -->

  </div>
    {{-- End of Container --}}

    {{-- Footer --}}

        @include('includes.homepage-footer')

    {{-- End of Footer  --}}

 {{-- Bootstrap core JavaScript --}}
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>