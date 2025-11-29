@extends('layout.layout')

@section('title', 'Result')
<link rel="stylesheet" href="{{ asset('assets/css/bed.css') }}">

@section('content')
<div class="container">
    <h1>Search Results</h1>

    @if($products->isEmpty())
        <p>No products found for "{{ $query }}".</p>
    @else
        <p>Showing results for "{{ $query }}":</p>
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                    <div class="card-body">
                        <h3 class="card-title">{{ $product->name }}</h3>
                        <p class="card-text">RS.{{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 
