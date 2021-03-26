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

        <div class="col">

            <h2 class="pt-4">{{ $user->name }}</h2>
            <hr>
            <div class="row">
                @if ($user->profile_image == null)
                    <img class="img-profile rounded-circle" width="150" height="150" src="{{ asset('img/undraw_profile.svg') }}">
                @else 
                    <img class="img-profile rounded-circle" width="150" height="150" src="{{ asset('/img') }}/{{$user->profile_image}}">
                @endif
                <div class="col">
                    <p>{{ $user->short_bio }}</p>
                </div>
            </div>
            <hr>


        </div>
          

        <!-- Blog Post -->
        @if ($authorPosts->count() > 0)
            @foreach ($authorPosts as $post)
                <div class="container">
                    <div class="card">
                        <div class="row">
                            <div class="col-md">
                                <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->post_slug]) }}">
                                    <img class="mt-2 mb-2 ml-2 img-fluid" src="{{ asset('/img') }}/{{$post->post_image}}" alt="Responsive image">
                                </a>
                            </div>
                            <div class="col-md">
                                <h3 class="mt-2">
                                    <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->post_slug]) }}">{{ $post->post_title }}</a>
                                </h3>
                                <p>{!! Str::words($post->post_body, 15, '...')  !!}</p>
                                <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->post_slug]) }}" class="btn btn-primary">Read More &rarr;</a>
                                <div class="mt-3 text-muted">
                                    <span class="mr-2">
                                        <i class="fas fa-user ml-2"></i>
                                        <a href="{{ route('author.page', ['user_name' => $post->user->name]) }}">{{ $post->user->name }}</a>
                                    </span>
                                    <span>
                                        <i class="fas fa-clock" ml-2></i> {{ $post->created_at->diffForHumans() }} 
                                    </span>
                                    @if ($post->categories->count() > 0)
                                        @foreach ($post->categories as $category)
                                            <span>
                                                <i class="fas fa-folder ml-1"></i>
                                                <a href="{{ route('category.page', ['category_name' => $category->category_name]) }}">
                                                    {{ $category->category_name }}
                                                </a>
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach

            {{ $authorPosts->links() }}

        @else 
            <h3>No Posts Found in with this user!</h3>
        @endif


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