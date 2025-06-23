@extends('layouts.app')

@section('title', 'Transaction')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Data Transaction</h1>
        </div>
        <div>
            <a href="{{ route('transaction.create') }}" class="btn btn-primary">
                Add
            </a>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>#</th>
            <th>Date</th>
            <th>Total Product</th>
            <th>Total Transaction</th>
            <th>Action</th>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td>{{ $transaction->details->count() }}</td>
                <td>{{ $transaction->total_price }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('transaction.detail', $transaction->id) }}" class="btn btn-sm btn-info">
                            Detail
                        </a>
                    </div>
                </td>
            </tr>

            @empty

            <tr>
                <td>Data tidak ditemukan atau belum ada.</td>
            </tr>

            @endforelse
        </tbody>
    </table>
@endsection 