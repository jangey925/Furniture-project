@extends('layout.app')

@section('title', 'Add Product')
<link rel="stylesheet" href="{{ asset('assets/css/addproduct.css') }}">

@section('content')
    <div class="container mt-0">
        <h1 class="text-center mb-4">Add Product</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Product Form -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <h2 class="section-title">General Information</h2>
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Enter product description"></textarea>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <h2 class="section-title">Pricing</h2>
                        <div class="form-group">
                            <label for="price">Base Price</label>
                            <input type="number" name="price" id="price" class="form-control" step="0.01"
                                placeholder="Enter price" required>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <h2 class="section-title">Inventory</h2>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control"
                                placeholder="Enter quantity" required>
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
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                <button type="submit" class="btn btn-primary py-2 px-4">Add Product</button>
            </div>
        </form>

        <!-- Product List -->
        <h2 class="mt-5">Product List</h2>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                        <td>
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="Product Image"
                                    style="width: 50px; height: 50px;">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <!-- Delete Button (with confirmation) -->
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
