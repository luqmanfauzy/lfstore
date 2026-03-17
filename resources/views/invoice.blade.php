<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            padding: 40px;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        td,
        th {
            border-bottom: 1px solid #ddd;
            padding: 8px;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">INVOICE</div>

    <p>Tanggal: {{ $date }}</p>
    <p>Customer: {{ $customer }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>{{ $item['subtotal'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total: Rp {{ number_format($total) }}</p>

</body>

</html>