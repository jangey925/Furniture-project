@extends('layout.layout')

@section('title', 'Home Page')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/furniture.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">


   
    <section class="hero-section">
        <div class="content">
            <h1>Our manufactured is from natural wood & steel.</h1>
            <p>Offer quality products, ensure customer satisfaction, and diverse furniture products.</p>
            <button class="learn-button">Learn More</button>
        </div>
        <div class="hero-image">
            <img src="{{ asset('assets/images/home/bedroom.jpg') }}" alt="Bedroom">
        </div>
    </section>

  
    <!-- Features Section -->
    <section class="features">
        <h1>Features</h1>

        <!-- Feature 1 -->
        <div class="feature">
            <div class="feature-text">
                <h3>Eco-Friendly Materials</h3>
                <p>Using sustainably sourced wood.</p>
            </div>
        </div>

        <!-- Feature 2 -->
        <div class="feature">
            <div class="feature-text">
                <h3>Handcrafted</h3>
                <p>Made with hand.</p>
            </div>
        </div>

        <!-- Feature 3 -->
        <div class="feature">
            <div class="feature-text">
                <h3>Durable</h3>
                <p>Built to last a lifetime.</p>
            </div>
        </div>

        <!-- Feature 4 -->
        <div class="feature">
            <div class="feature-text">
                <h3>Modern Design</h3>
                <p>Aesthetically pleasing and functional.</p>
            </div>
        </div>
    </section>

    {{-- image gallery --}}
    <section class="gallery-sec">

        <h1>Gallery</h1>
        <div class="grid-gallery">
            <img src="{{ asset('assets/images/gallery/galleryimg1.png') }}" alt="Dining Table">
            <img src="{{ asset('assets/images/gallery/galleryimg2.png') }}" alt="Chair">
            <img src="{{ asset('assets/images/gallery/galleryimg3.png') }}" alt="Wooden Dresser">
            <img src="{{ asset('assets/images/gallery/galleryimg4.png') }}" alt="Sofa and Table">
            <img src="{{ asset('assets/images/gallery/galleryimg5.png') }}" alt="Dining Set">
            <img src="{{ asset('assets/images/gallery/galleryimg6.png') }}" alt="Orange Sofa">
        </div>
    </section>

   
    <section class="product-gallery">
    <h2>Categories</h2>
    <div class="product-grid">
        @foreach ($categories as $category) 
            <div class="product-item">
                <a href="{{ route('category.show', $category->id) }}"> 
                    @if ($category->image) 
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                    @else
                        <img src="{{ asset('assets/images/home/homesofa.png') }}" alt="Default Image"> 
                    @endif
                    <div class="overlay-text">{{ $category->name }}</div>
                </a>
            </div>
        @endforeach
    </div>
</section>


    {{-- why to chose  --}}
    <section class="why-choose-us" id="service">
        <div class="container">
            <div class="section-header">
                <h2>Why Choose Us</h2>
                <p>Choose us for fast and handcrafted with modern design as weel as you can customize as per your need.</p>
            </div>
            <div class="why-features">
                <div class="why-feature">
                    <i class="fa fa-truck"></i>
                    <h3>Fast & Free Shipping</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident, cupiditate?</p>
                </div>
                <div class="why-feature">
                    <i class="fa fa-box"></i>
                    <h3>Easy to Shop</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis, voluptatem.</p>
                </div>
                <div class="why-feature">
                    <i class="fa fa-headset"></i>
                    <h3>24/7 Support</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis, voluptatem.</p>
                </div>
                <div class="why-feature">
                    <i class="fa fa-retweet"></i>
                    <h3>Hassle Free Returns</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis, voluptatem.</p>
                </div>
            </div>
        </div>
    </section>




    <section class="about-section" id="about-us">
        <div class="about-content">
            <h2>About Us</h2>
            <div class="about-details">
                <div class="text-content">
                    <h3>Who We Are</h3>
                    <p>
                        We pride ourselves on being the most loved furniture store in the world.
                        We've got everything from couches, to beds, to dining tables, and much more.
                    </p>
                    <div class="blue-circle"></div>
                </div>
                <div class="image-content">
                    <img src="{{ asset('assets/images/home/Rectangle1.png') }}" alt="Furniture 1">
                    <img src="{{ asset('assets/images/home/Rectangle2.png') }}" alt="Furniture 2">
                    <img src="{{ asset('assets/images/home/Rectangle3.png') }}" alt="Furniture 3">
                </div>
            </div>
        </div>
    </section>

@endsection
