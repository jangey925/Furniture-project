<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">



    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">
                @if (Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="User Image">
                @else
                    <a href="{{ route('profile.show') }}">
                        <div class="profile-initials">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </a>
                @endif
            </div>


            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>

            </div>
        </div>


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
                    <a href="{{ route('admin.dashbord') }}" class="nav-link">
                        <i class="fa-solid fa-house"></i>
                        <p>Home</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link">
                        <i class="fa-solid fa-user-group"></i>
                        <p> Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.category') }}" class="nav-link">
                        <i class="fa-solid fa-list"></i>
                        <p> Category</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products.create') }}" class="nav-link">
                        <i class="fa-solid fa-tags"></i>
                        <p> Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.orders') }}" class="nav-link">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <p> Orders</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.mail') }}" class="nav-link">
                        <i class="fa-solid fa-envelope"></i>
                        <p> Mails</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fa-solid fa-truck-fast"></i>
                        <p> Shipping</p>
                    </a>
                </li> --}}




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
