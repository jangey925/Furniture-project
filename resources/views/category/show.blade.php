@extends('layout.layout')

{{-- @section('title', isset($category) ? $category->name . ' Category' : 'Category Not Found') --}}

@section('title','Products')

<link rel="stylesheet" href="{{ asset('assets/css/bed.css') }}">

@section('content')
    <div class="container">
        @if (isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @else
            {{-- @if (isset($category)) --}}

            @if (isset($products) && $products->isNotEmpty())
                <div class="category-grid">
                    @foreach ($products as $product)
                        <div class="category-item">
                            <img src="{{ url($product->image) }}" alt="{{ $product->name }}">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ $product->description }}</p>
                            <p class="price">Rs. {{ number_format($product->price, 2) }}</p>
                            <div class="actions">
                                <form action="{{ route('cart.add') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn add-to-cart">Add to Cart</button>
                                </form>

                                @auth
                                    <a href="{{ route('cart.checkout') }}" class="btn edit">Edit</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn edit">Login To Edit</a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No products available in this category.</p>
            @endif
            {{-- @endif --}}
        @endif
    </div>
@endsection
