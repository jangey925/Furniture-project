@extends('layout.app')

@section('title', 'Create Category')

@section('content')
<div class="container mt-0">
    <h1>Create Category</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

         <div class="form-group mt-3">
        <label for="image">Category Image</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

        <button type="submit" class="btn btn-primary mt-3">Create Category</button>
    </form>

    <h2 class="mt-5">Category List</h2>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 100px; height: auto;">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.editcategory', $category->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                        <form action="{{ route('admin.deletecategory', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
