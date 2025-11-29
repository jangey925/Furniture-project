<nav class="navbar">
    <div class="navbar-container">

        <!-- Brand/Logo -->
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('assets/images/logo.jpeg') }}" alt="furnitureland">
        </a>

        <!-- Navigation Links -->
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('shop.index') }}">Shop</a></li>
            <li><a href="#service">Services</a></li>
            <li><a href="#about-us">About Us</a></li>
            <li><a href="{{ route('contact.show') }}">Contact Us</a></li>
        </ul>

        <!-- Search Form -->
        <form class="search-form" action="{{ route('products.search') }}" method="GET">
            <input type="text" class="search-input" placeholder="Search Products..." name="query">
            <button type="submit" class="search-button">
                <i class="fa fa-search"></i>
            </button>
        </form>

        <!-- Cart Icon -->
        <div class="cart-icon">
            <a href="{{ route('cart.index') }}">
                <i class="fa-solid fa-cart-shopping"></i>
                <span id="cart-count" class="cart-badge">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
            </a>
        </div>

        <!-- User Profile Dropdown -->
        <div class="navbar-right">
            @auth
                <div class="dropdown profile-dropdown">
                    <!-- Profile Image or Initials -->
                    @if (Auth::user()->profile_image)
                        <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('default-profile.png') }}"
                            alt="Profile Image" class="profile-circle">
                    @else
                        <div class="profile-initials">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif


                    <div class="dropdown-menu">
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashbord') : route('customer.dashbord') }}"
                            class="dropdown-item">
                            Dashboard
                        </a>

                        <a href="#" class="dropdown-item"
                            onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="login-link">Login</a>
                <a href="{{ route('signup') }}" class="signup-link">Signup</a>
            @endauth
        </div>

    </div>
</nav>
