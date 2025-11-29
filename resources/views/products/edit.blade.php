@extends('layout.app')

@section('title', 'Edit Product')

<link rel="stylesheet" href="{{ asset('assets/css/addproduct.css') }}">

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Product</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Product Form -->
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf
            @method('PUT')  <!-- This is important for updating -->

            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <h2 class="section-title">General Information</h2>
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <h2 class="section-title">Pricing</h2>
                        <div class="form-group">
                            <label for="price">Base Price</label>
                            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" placeholder="Enter price" required>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <h2 class="section-title">Inventory</h2>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" placeholder="Enter quantity" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <h2 class="section-title">Category</h2>
                        <div class="form-group">
                            <label for="category_id">Product Category</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card">
                        <h2 class="section-title">Product Media</h2>
                        <div class="form-group">
                            <label for="image">Product Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary py-2 px-4">Update Product</button>
            </div>
        </form>
    </div>
@endsection
