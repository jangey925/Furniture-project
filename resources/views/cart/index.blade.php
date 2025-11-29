@extends('layout.layout')

@section('title', 'Your Cart')

<link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">

@section('content')
<div class="container">
    <h1>Your Cart</h1>

   
    @if(session('success'))
        <div class="alert-success-custom">
            {{ session('success') }}
        </div>
    @endif

  
    @if(session('error'))
        <div class="alert-error-custom">
            {{ session('error') }}
        </div>
    @endif

    <!-- Check if cart is not empty -->
    @if(session('cart') && count(session('cart')) > 0)
        <div class="cart-items">
            @foreach(session('cart') as $id => $item)
                <div class="cart-item">
                   
                    <div class="item-image">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    </div>

                
                    <div class="item-details">
                        <h5>{{ $item['name'] }}</h5>
                        <p class="item-price">Price: RS.{{ $item['price'] }}</p>
                    </div>

                  
                    <div class="item-quantity">
                        <form action="{{ route('cart.update', $id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width: 60px;">
                            <button type="submit" class="save-btn">Update</button>
                        </form>
                    </div>

                  
                    <div class="item-actions">
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

       
        <div class="cart-summary">
            <h4>
                Total: Rs.
                {{ array_sum(array_map(function($item) {
                    return $item['price'] * $item['quantity'];
                }, session('cart'))) }}
            </h4>
            <a href="{{ route('cart.checkout') }}" class="checkout-btn">Proceed to Checkout</a>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
