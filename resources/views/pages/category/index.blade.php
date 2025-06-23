@extends('layouts.app')

@section('title', 'Category')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Data Category</h1>
        </div>
        <div>
            <a href="{{ route('category.create') }}" class="btn btn-primary">
                Add
            </a>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning">
                            Edit
                        </a>
                        <form action="{{ route('category.destroy', $category->id) }}" method="post">
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