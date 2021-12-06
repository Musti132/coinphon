<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CoinPhon - Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid mt-4">
        <h2 class="text-center mb-2">Orders</h2>
        <table class="table">
            <thead>
                <tr class="table">
                    <th scope="col">Order ID</th>
                    <th >Amount</th>
                    <th >Address</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <th scope="row">{{ $order->order_id }}</th>
                    <th>{{ $order->amount_fiat}} ({{$order->amount}})</th>
                    <th>{{ $order->address }}</th>
                    <th>{{ $order->status_message }}</th>
                    <th>{{ $order->created_at }}</th>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>