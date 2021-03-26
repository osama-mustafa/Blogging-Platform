{{-- Sidebar Widgets Column --}}
<div class="col-md-4 mt-3">

    {{-- Search Widget --}}

    {{-- <div class="card my-4"> --}}
    <div class="card mt-5">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
        <div class="input-group">
            <form action="{{ route('search.engine') }}" method="GET">
                @csrf
                <input type="text" name="search" class="form-control mb-2" placeholder="Search for...">
                <span class="input-group-append">
                <button class="btn btn-primary" type="submit">Go!</button>
                </span>    
            </form>
        </div>
        </div>
    </div>

    {{-- Categories Widget --}}

    @if (!$categories->isEmpty())
        <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                    @foreach ($categories as $category)
                        <li class="lead">
                            <a href="{{ route('category.page', ['category_name' => $category->category_name]) }}">{{ $category->category_name }}</a>
                        </li>
                    @endforeach
                </ul>
                </div>
            </div>
            </div>
        </div>
    @endif

    {{-- Tags Widget --}}

    @if ($tags->count() > 0)
        <div class="card my-4">
            <h5 class="card-header">Tags</h5>
            <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    @foreach ($tags as $tag)
                        <a href="{{ route('tag.page', ['tag_name' => $tag->tag_name]) }}" class="badge badge-pill badge-primary lead" style="font-size: 14">{{ $tag->tag_name }}</a>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    @endif



    {{-- Side Widget --}}
    @auth
        <div class="card my-4">
            <h5 class="card-header">Welcome {{ auth()->user()->name }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="{{ Route('home') }}" class="lead" style="text-decoration: none;"><i class="fas fa-cog"></i> Dashoboard</a>
                        </li>
                        <li>
                            <a href="{{ route('edit.profile') }}" class="lead" style="text-decoration: none;"><i class="fas fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="lead" style="text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>    
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    @endauth

</div>
