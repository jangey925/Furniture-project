@extends('layout.app')

@section('title', 'Edit Category')

@section('content')
<div class="container mt-0">
    <h1>Edit Category: {{ $category->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.updatecategory', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <label for="image">Category Image</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    @if($category->image)
        <div class="mt-3">
            <p>Current Image:</p>
            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 100px; height: auto;">
        </div>
    @endif

        <button type="submit" class="btn btn-primary mt-3">Update Category</button>
    </form>
</div>
@endsection
