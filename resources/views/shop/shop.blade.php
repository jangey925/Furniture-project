@extends('layout.layout') 

@section('title', 'Shop by Category')

<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

@section('content')
<div class="container">
  <!-- Left: Categories -->
  <div class="categories">
    <h1>Shop by <span>Categories</span></h1>
    <p>Best Affordable furniture manufacturer in Nepal. The unique design of Home Decor, office setup.</p>
    <ul class="category-list">
      @foreach ($categories as $index => $category)
        <a href="{{ route('category.show', $category->id) }}">
          <li>
            <span>{{ sprintf('%02d', $index + 1) }}</span> {{ $category->name }} <span class="arrow">&#8599;</span>
          </li>
        </a>
      @endforeach
    </ul>
  </div>

  <!-- Right: Image -->
  <div class="image-container">
    <img src="{{ asset('assets/images/home/homesofa.png') }}" alt="Furniture">
  </div>
</div>
@endsection
