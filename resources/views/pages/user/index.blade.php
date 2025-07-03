@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Data User</h1>
        </div>
        <div>
            <a href="{{ route('user.create') }}" class="btn btn-primary">
                Add
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-capitalize">{{ $user->role }}</td>
                <td class="text-capitalize">{{ $user->status ? 'Active' : 'Non Active' }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                            Edit
                        </a>
                        {{-- <form action="{{ route('user.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form> --}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection