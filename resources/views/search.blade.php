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

        {{-- <h1 class="my-4">Blogging Platform</h1> --}}

        @if ($posts->count() > 0)
            <h1 class="pt-5">Search Results for: {{ $search }}</h1>
        <hr>
        @else 
            <h1 class="pt-5">No Results!</h1>
            <hr>
        @endif

        <!-- Blog Post -->
        @if ($posts->count() > 0)
            @foreach ($posts as $post)
                <div class="container">
                    <div class="card">
                        <div class="row">
                            <div class="col-md">
                                <img class="mt-2 mb-2 ml-2 img-fluid" src="{{ asset('/img') }}/{{$post->post_image}}" alt="Responsive image">
                            </div>
                            <div class="col-md">
                                <h3 class="mt-2">
                                    <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->post_slug]) }}">{{ $post->post_title }}</a>
                                </h3>
                                <p>{{ Str::words($post->post_body, 15, '...')  }}</p>
                                <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->post_slug]) }}" class="btn btn-primary">Read More &rarr;</a>
                                <div class="mt-3 text-muted">
                                    Posted on {{ $post->created_at }} by
                                    <a href="#">{{ $post->user->name }}</a>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach

            {{ $posts->links() }}
        @else 
            <h3>Sorry ... There are no results found with this keyword!</h3>
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