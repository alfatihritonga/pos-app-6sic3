@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="card">
    <div class="card-header">
        Edit Product
    </div>
    <div class="card-body">
        <form action="{{ route('product.update', $product->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ $product->price }}">
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" id="stock" name="stock" class="form-control" value="{{ $product->stock }}">
            </div>
            
            <div class="gap-3">
                <a href="{{ route('product.index') }}" class="btn btn-light">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">Save Change</button>
            </div>
        </form>
    </div>
</div>
@endsection