<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 20px;
        }
        .header, .footer {
            text-align: center;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .meta {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #444;
        }
        th, td {
            padding: 6px 8px;
            text-align: left;
        }
        tfoot td {
            font-weight: bold;
        }
        .right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Transaction Report</div>
        <div>{{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y') }}</div>
    </div>

    <div class="meta">
        <p><strong>Transaction ID:</strong> {{ $transaction->id }}</p>
        @if($transaction->user)
        <p><strong>Cashier:</strong> {{ $transaction->user->name }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th class="right">Qty</th>
                <th class="right">Price</th>
                <th class="right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->details as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product->name }}</td>
                <td class="right">{{ $detail->quantity }}</td>
                <td class="right">{{ number_format($detail->price, 0, ',', '.') }}</td>
                <td class="right">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="right">Total</td>
                <td class="right">{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="4" class="right">Cash</td>
                <td class="right">{{ number_format($transaction->cash_received, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="4" class="right">Change</td>
                <td class="right">{{ number_format($transaction->change_returned, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Thank you for your transaction!</p>
    </div>
</body>
</html>
