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

        {{-- <h1 class="my-4">Blog System
          <small>with Laravel 8</small>
        </h1> --}}

            <h1 class="my-4">Contact Us</h1>
            <hr>

        <!-- Blog Post -->
        @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error) 
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                </div>
            @endforeach

        @endif

        <div class="col-md-10 mb-4">
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name <sup><i class="fas fa-asterisk fa-xs" style="color: red"></i></sup></label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email address <sup><i class="fas fa-asterisk fa-xs" style="color: red"></i></sup></label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="title">Title <sup><i class="fas fa-asterisk fa-xs" style="color: red"></i></sup></label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="message">Message <sup><i class="fas fa-asterisk fa-xs" style="color: red"></i></sup></label>
                    <textarea class="form-control" name="message" id="" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>        
        </div>



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