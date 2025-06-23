@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <h1 class="h3 mb-3">Shopping Cart</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        {{-- data product --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Menu
                </div>

                @foreach($categories as $category)
                <div class="card-body">
                    <h4>{{ $category->name }}</h3>
                    <div class="row">
                        @foreach($category->products as $product)
                            <div class="col-md-6">
                                <div class="card mb-1">
                                    <div class="card-body">
                                        <h5>{{ $product->name }}</h5>
                                        <p>Price: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p>Stock: {{ $product->stock }}</p>
                                        <form action="{{ route('transaction.cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-sm btn-primary w-100">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- cart --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Cart
                </div>

                <div class="card-body">
                    @if(count($cart) > 0)
                    <div class="table-responsive mb-3" style="overflow-x: auto;">
                        <table class="table table-bordered align-middle text-nowrap">
                            <thead class="table-light">
                                <tr class="text-start">
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('transaction.cart.update') }}" class="d-flex align-items-center gap-2">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                                class="form-control form-control-sm" style="width: 60px;">
                                            <button type="submit" class="btn btn-sm btn-outline-warning">Ubah</button>
                                        </form>
                                    </td>
                                    <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('transaction.cart.remove', $item['product_id']) }}" class="btn btn-sm btn-outline-danger">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @php
                        $total = number_format(array_sum(array_column($cart, 'subtotal')), 0, ',', '.');
                    @endphp

                    <!-- Checkout Form with Cash Input -->
                    <h6>Amount:</h6>
                    <h4 class="text-primary mb-4">Rp {{ $total }}</h4>

                    <form action="{{ route('transaction.checkout') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="cash" class="form-label ">Cash</label>
                            <input type="number" name="cash" id="cash" class="form-control" min="{{ $total }}" placeholder="input cash received" required>
                        </div>
                        <a href="{{ route('transaction.cancel') }}" class="btn btn-outline-danger">Cancel</a>
                        <button type="submit" class="btn btn-success">Pay Now</button>
                    </form>

                    @else
                    <p class="text-secondary">Empty cart.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection