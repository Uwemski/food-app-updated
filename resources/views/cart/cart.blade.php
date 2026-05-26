<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if(empty($cart))
        <div>
            <h2>Cart is Empty at the moments, shop products and add to cart</h2>
            <a href="{{route('products.show')}}">Products page</a>
        </div>
    @endif

    @if(session('success'))
        <div class="">{{session('success')}}</div>
    @endif

    @if(session('error'))
        <div class="">{{session('error')}}</div>
    @endif

    <table border='1'>
        <thead>
            <tr>
                <td>s/n</td>
                <td>Name</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Amount</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $key => $value)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$value['name']}}</td>
                    <td>{{$value['price']}}</td>
                    <td>{{$value['quantity']}}</td>
                    <td>{{$subtotal}}</td>
                    <td>
                        <form action="{{route('cart.delete', $key)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: right;">
                    Subtotal: &#8358; {{number_format($subtotal, 2)}}
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: right;">
                    Delivery Fee: &#8358; {{number_format($deliveryFee, 2)}}
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: right;">
                    Total: <strong>&#8358; {{number_format($total, 2)}}</strong>
                </td>
            </tr>
        </tbody>
    </table>
    <div>
        <a href="{{route('products.show')}}">Continue shopping</a><br>
        @if(!empty($cart))
            <a href="{{route('checkout.index')}}">Proceed to checkout</a>
        @endif
    </div>
    <div>
        <form action="{{route('cart.clear')}}" method="POST">
            @method('DELETE')
            @csrf
            <button style="background-color:red">Clear Cart</button>
        </form>
        
    </div>
    
</body>
</html>