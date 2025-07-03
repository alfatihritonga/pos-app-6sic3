@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="card">
    <div class="card-header">
        Edit User
    </div>
    <div class="card-body">
        <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control">
                @error('email')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" id="password" name="password" class="form-control">
                @error('password')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-control">
                    <option selected value="{{ $user->role }}" class="text-capitalize">{{ $user->role }} (selected)</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                </select>
                @error('role')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option selected value="{{ $user->status }}" class="text-capitalize">{{ $user->status ? 'Active' : 'Non Active' }} (selected)</option>
                    <option value="1">Active</option>
                    <option value="0">Non Active</option>
                </select>
                @error('status')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="gap-3">
                <a href="{{ route('user.index') }}" class="btn btn-light">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">Save Change</button>
            </div>
        </form>
    </div>
</div>
@endsection