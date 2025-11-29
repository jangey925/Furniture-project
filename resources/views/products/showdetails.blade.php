@extends('layout.layout')

@section('title', 'Product Details')

@section('content')
    <div class="product-details" style="padding: 20px;">

        <div class="product-container" style="display: flex; gap: 40px; align-items: flex-start; flex-wrap: wrap;">
            <!-- Product Image -->
            <div class="product-image" style="flex: 1; max-width: 500px;">
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                    style="width: 100%; max-width: 500px; height: 450px; object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">
            </div>

            <!-- Product Info -->
            <div class="product-info" style="flex: 2; padding: 15px; border-radius: 5px;">
                <h1 style="margin-bottom: 15px; font-size: 1.8em; font-weight: bold;">{{ $product->name }}</h1>

                <!-- Product Description -->
                <p style="margin-bottom: 15px; font-size: 1em; color: #666; line-height: 1.5;">
                    <strong>Description:</strong> <br>{{ $product->description }}
                </p>

                <!-- Product Price -->
                <p style="font-size: 1.5em; color: #52a8d6; font-weight: bold; margin-bottom: 15px;">
                    Rs.{{ number_format($product->price, 2) }}
                </p>

                <!-- Stock Status -->
                @if ($product->quantity > 0)
                    <p style="font-size: 1em; color: #28a745; font-weight: bold; margin-bottom: 15px;">
                        In Stock ({{ $product->quantity }} available)
                    </p>
                @else
                    <p style="font-size: 1em; color: #dc3545; font-weight: bold; margin-bottom: 15px;">
                        Out of Stock
                    </p>
                @endif


                <p style="margin-bottom: 10px; font-size: 1em; color: #333;">
                    <strong>Category:</strong> {{ $product->category->name }}
                </p>




                <div class="add-to-cart" style="margin-top: 20px;">
                    @if ($product->quantity > 0)
                        <form action="{{ route('cart.add') }}" method="POST" style="margin: 0;">
                            @csrf
                            <input type="hidden" name="product[id]" value="{{ $product->id }}">
                            <button type="submit" class="btn add-to-cart"
                                style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1em;">
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <button type="button" disabled
                            style="background-color: #6c757d; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: not-allowed; font-size: 1em;">
                            Out of Stock
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
