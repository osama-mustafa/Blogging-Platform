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

        <h1 class="my-4">About</h1>
        <hr>

        <img class="mt-2 mb-2 ml-2 img-fluid" width="50%" src="{{ asset('/img/laravel.png') }}" alt="">

        <!-- Blog Post -->
        <div class="container">
            <p class="mt-5">Blog System Created by: Osama Mustafa with Laravel 8 Framework, The Theme of Homepage and Admin Dashboard Are from <a href="https://startbootstrap.com/" target="_blank">startbootstrap.com</a></p>
            <p>
                Made with:
                <ul>
                    <li>HTML</li>
                    <li>CSS</li>
                    <li>PHP</li>
                    <li>Laravel</li>
                    <li>Bootstrap</li>
                    <li>Fontawesome</li>
                </ul>
            </p>
        </div>
        <hr>

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