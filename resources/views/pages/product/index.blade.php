@extends('layouts.app')

@section('title', 'Product')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Data Product</h1>
        </div>
        <div>
            <a href="{{ route('product.create') }}" class="btn btn-primary">
                Add
            </a>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">
                            Edit
                        </a>
                        <form action="{{ route('product.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection