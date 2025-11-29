@extends('layout.app')

@section('content')
<div class="container mt-0">
    <h1 class="mb-4">All Orders</h1>

    @if($orders->isNotEmpty())
        <div class="row">
            @foreach ($orders as $order)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Order ID: {{ $order->id }}</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Order Date:</strong> {{ $order->created_at->format('F d, Y') }}</p>
                            
                            <!-- Display product image and name -->
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" width="100%"  height="250px"class="me-3">
                            </div>
                            
                           <p><strong>{{ $order->product->name }}</strong></p>
                            <p><strong>Order By:</strong> {{ $order->user->name }}</p>
                           <p><strong>Province:</strong> {{ $order->province }}</p>
                            <p><strong>Address:</strong> {{ $order->address }}</p>
                            
                            <!-- Display height and width -->
                            @if($order->height && $order->width)
                                <p><strong>Dimensions:</strong> {{ $order->height }} x {{ $order->width }} ft</p>
                            @else
                                <p><strong>Dimensions:</strong> Not specified</p>
                            @endif
                            
                          
                            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>

                            <!-- Display total -->
                            <p><strong>Total:</strong> Rs.{{ number_format($order->total, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No orders found.</p>
    @endif
</div>
@endsection
