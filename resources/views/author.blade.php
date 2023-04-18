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

                <x-images.user
                    :user="$user"
                    :default-image="asset('img/profile.png')"
                    :user-image='asset("storage/images/{$user->image}")'
                    :width='200'
                    :height='200'
                    :class="'rounded'"
                />

                <div class="col">
                    <p>{{ $user->bio }}</p>
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
                                @if ($post->image)
                                    <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->slug]) }}">
                                        <img class="mt-2 mb-2 ml-2 img-fluid" src="{{ asset('/img') }}/{{$post->image}}" alt="Responsive image">
                                    </a>
                                @else
                                    <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->slug]) }}">
                                        <img class="mt-2 mb-2 ml-2 img-fluid" src="{{ asset('/img/post.png') }}" alt="Responsive image">
                                    </a>
                                @endif
                            </div>
                            <div class="col-md">
                                <h3 class="mt-2">
                                    <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->slug]) }}">{{ $post->post_title }}</a>
                                </h3>
                                <p>{!! Str::words($post->post_body, 15, '...')  !!}</p>
                                <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->slug]) }}" class="btn btn-primary">Read More &rarr;</a>
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
                                                <a href="{{ route('category.page', ['category_name' => $category->name]) }}">
                                                    {{ $category->name }}
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