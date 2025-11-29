<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image"> --}}
                    @if(Auth::user()->profile_image)
                        <img 
                            src="{{ asset('storage/profile_images/' . Auth::user()->profile_image) }}" 
                            alt="Profile Image"
                            class="profile-circle">
                    @else
                        <!-- Default Initial (First Letter of Name) -->
                        <div class="profile-initials">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('customer.dashbord') }}" class="nav-link">
                        <i class="fa-solid fa-house"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('shop.index') }}" class="nav-link">
                        <i class="fa-solid fa-list"></i>
                        <p> Category</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fa-solid fa-tags"></i>
                        <p> Products</p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <p> Orders</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contact.show') }}" class="nav-link">
                        <i class="fa-solid fa-envelope"></i>
                        <p> Contact Us</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fas fa-history"></i>
                        <p>History</p>
                    </a>
                </li> --}}

                 <li class="nav-item">
                    <a href="{{route('customer.notification')}}" class="nav-link">
                        <i class="fa-solid fa-bell"></i>
                        <p>Notification</p>
                    </a>
                </li>

                
                    <li class="nav-item">
                            <a href="{{route('profile.show')}}" class="nav-link">
                                <i class="fa-solid fa-user"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </button>
                            </form>
                        </li>
                
                </li>


            </ul>
        </nav>
    </div>
</aside>
