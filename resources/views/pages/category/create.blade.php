@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
<div class="card">
    <div class="card-header">
        Add Category
    </div>
    <div class="card-body">
        <form action="{{ route('category.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            
            <div class="gap-3">
                <a href="{{ route('category.index') }}" class="btn btn-light">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection