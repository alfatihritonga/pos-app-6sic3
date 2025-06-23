@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
<div class="card">
    <div class="card-header">
        Add Category
    </div>
    <div class="card-body">
        <form action="{{ route('category.update', $category->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" value="{{ $category->name }}" class="form-control">
            </div>
            
            <div class="gap-3">
                <a href="{{ route('category.index') }}" class="btn btn-light">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">Save Change</button>
            </div>
        </form>
    </div>
</div>
@endsection