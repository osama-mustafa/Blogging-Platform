        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Homepage <i class="fas fa-home"></i></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="far fa-newspaper fa-3x text-gray-300"></i>
                    <span>Posts</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Posts</h6>

                        <a class="collapse-item" href="{{ route('posts.create') }}">Create Post</a>
                        
                            @if (auth()->user()->is_admin)
                                <a class="collapse-item" href="{{ route('posts.index') }}">All Posts</a>
                                <a class="collapse-item" href="{{ route('trashed.posts') }}">Trashed Posts</a>
                            @endif

                    </div>
                </div>
            </li>


            @if (auth()->user()->is_admin)

                <!-- Users Section -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fas fa-tags fa-2x text-gray-300"></i>
                        <span>Users</span>
                    </a>
                </li>    


                {{-- Categories Section --}}

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Nav Item - Pages Collapse Menu -->

                        <!-- Categories Section -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">
                                <i class="fas fa-tags fa-2x text-gray-300"></i>
                                <span>Categories</span>
                            </a>
                        </li>    
                

                {{-- Comments Section --}}

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('comments.index') }}">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                            <span>Comments</span>
                        </a>
                    </li>


                <!-- Messages Section -->

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('messages.index') }}">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                            <span>Messages</span>
                        </a>
                    </li>


                <!-- Tags Section -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tags.index') }}">
                        <i class="fas fa-tags fa-2x text-gray-300"></i>
                        <span>Tags</span>
                    </a>
                </li>    
                                              
            @endif

        </ul>
        <!-- End of Sidebar -->
