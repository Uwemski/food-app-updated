<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <table border='1'>
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Customer name</th>
                    <th>Customer Address</th>
                    <th>Customer Phone</th>
                    <th>Total</th>
                    <th>Transaction reference</th>
                    <th>Payment Status</th>
                    <th>status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$order->customer_name}}</td>
                    <td>{{$order->customer_address}}</td>
                    <td>{{$order->customer_phone}}</td>
                    <td>{{$order->total_amount}}</td>
                    <td>{{$order->transaction_ref}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->status}}</td>
                    <!-- either use diffForHumans() or format('d/m/Y') -->
                    <td>{{$order->created_at->format('d/m/Y H:i' )}}</td>
                    <td><a href="{{route('orders.show', $order->id)}}">view</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>