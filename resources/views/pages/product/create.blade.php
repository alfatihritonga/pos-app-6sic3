@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="card">
    <div class="card-header">
        Add Product
    </div>
    <div class="card-body">
        <form action="{{ route('product.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option disabled selected>-- choose category --</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" id="price" name="price" class="form-control">
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" id="stock" name="stock" class="form-control">
            </div>
            
            <div class="gap-3">
                <a href="{{ route('product.index') }}" class="btn btn-light">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection