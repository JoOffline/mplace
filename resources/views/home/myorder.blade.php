<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
    @include('home.css')
    <style>
        .custom-table {
            border-collapse: separate;
            border-spacing: 0 15px;
            text-align: center;
        }

        .custom-table thead th {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 15px;
        }

        .custom-table tbody td {
            background-color: #f8f9fa;
            border: none;
            padding: 15px;
            vertical-align: middle;
        }

        .custom-table tbody tr:hover td {
            background-color: #e9ecef;
        }

        .custom-table tbody td img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 10px;
        }

        .custom-table tbody td .status {
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
        }

        .status-available {
            background-color: #28a745;
        }

        .status-unavailable {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="hero_area">
        <!-- header section starts -->
        @include('home.header')

        <table class="table custom-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beli as $order)
                <tr>
                    <td>{{ $order->product->title }}</td>
                    <td>{{ $order->product->price }}</td>
                    <td>{{ $order->status }}</td>
                    <td><img style="margin:auto; max-width: 100%; max-height: 100px; object-fit: cover;" src="{{ asset('products/' . $order->product->image) }}" alt="{{ $order->product->title }}"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
