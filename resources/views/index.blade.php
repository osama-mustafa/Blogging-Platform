@include('includes.homepage-header')

<body>

    {{-- HomePage Navbar --}}

        @include('includes.homepage-nav')
    
    {{--End of HomePage Navbar --}}

    <!-- Page Content -->
    <div class="container">

            <div class="row">

                <!-- Blog Entries Column -->
                <div class="col-md-8 pt-5">

                    {{-- <h1 class="my-4">Blogging Platform
                    <small></small></h1> --}}



                    <!-- Blog Post -->
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="card mb-4">
                                <div class="card-header">
                                    <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->slug]) }}">
                                        <h2>{{ $post->post_title }}</h2>
                                    </a>
                                </div>
                                <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->slug]) }}">
                                    <img class="card-img-top" src="{{ asset('/img') }}/{{$post->post_image}}" alt="Card image cap">
                                </a>
                            
                                <div class="card-body">
                                    <h2 class="card-title">{{ $post->title }}</h2>
                                    <p class="card-text">{!! Str::words($post->post_body, 15, '...')  !!}</p>
                                    <a href="{{ route('single.post', ['post_id' => $post->id, 'post_slug' => $post->slug]) }}" class="btn btn-primary">Read More &rarr;</a>
                                </div>
                                <div class="card-footer text-muted">
                                    <i class="fas fa-user"></i> <a href="{{ route('author.page', ['user_name' => $post->user->name]) }}" class="mr-1">{{ $post->user->name }}</a>

                                    @if ($post->categories->count() > 0)
                                        @foreach ($post->categories as $category)
                                            <i class="fas fa-folder mr-1"></i>
                                            <a href="{{ route('category.page', ['category_name' => $category->category_name]) }}">
                                                {{ $category->category_name }}
                                            </a>  
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else 
                        <p>There is no posts</p>
                    @endif

                        {{ $posts->links() }}

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