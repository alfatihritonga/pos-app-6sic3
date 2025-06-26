@extends('layouts.app')

@section('title', 'Detail Transaction')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1>Detail Transaction</h1>
        </div>
        <div>
            <a href="{{ route('transaction.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
    </div>

    <div class="fw-bold">
        Date : {{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y') }}
    </div>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Sub Total</th>
        </thead>
        <tbody>
            @forelse ($transaction->details as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ $detail->price }}</td>
                <td>{{ $detail->subtotal }}</td>
            </tr>

            @empty

            <tr>
                <td>Data tidak ditemukan atau belum ada.</td>
            </tr>

            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="fw-bold text-center">
                    Total
                </td>
                <td>
                    {{ $transaction->total_price }}
                </td>
            </tr>
            <tr>
                <td colspan="4" class="fw-bold text-center">
                    Cash
                </td>
                <td>
                    {{ $transaction->cash_received }}
                </td>
            </tr>
            <tr>
                <td colspan="4" class="fw-bold text-center">
                    Change
                </td>
                <td>
                    {{ $transaction->change_returned }}
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="mt-3 d-flex justify-content-end">
        <a href="{{ route('transaction.print', $transaction->id) }}" class="btn btn-secondary">
            Print
        </a>
    </div>
@endsection 