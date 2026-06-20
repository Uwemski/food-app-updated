<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-6xl mx-auto px-4 py-8">

        <!-- Page Title -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                Shopping Cart
            </h1>
            <p class="text-gray-500">
                Review your selected items before checkout.
            </p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-700 px-4 py-3">
                {{ session('error') }}
            </div>
        @endif

        <!-- Empty Cart -->
        @if(empty($cart))
            <div class="bg-white rounded-xl shadow p-8 text-center">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">
                    Your cart is currently empty
                </h2>

                <p class="text-gray-500 mb-6">
                    Browse our products and add items to your cart.
                </p>

                <a href="{{ route('home') }}"
                   class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">
                    Shop Products
                </a>
            </div>
        @else

            <!-- Cart Table -->
            <div class="bg-white rounded-xl shadow overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[700px]">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left">S/N</th>
                                <th class="px-4 py-3 text-left">Product</th>
                                <th class="px-4 py-3 text-left">Price</th>
                                <th class="px-4 py-3 text-left">Quantity</th>
                                <th class="px-4 py-3 text-left">Amount</th>
                                <th class="px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($cart as $key => $value)
                                <tr id="cart-row-{{$key}}"class="border-t">
                                    <td class="px-4 py-4">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-4 py-4 font-medium">
                                        {{ $value['name'] }}
                                    </td>

                                    <td class="px-4 py-4">
                                        ₦{{ number_format($value['price'], 2) }}
                                    </td>

                                    <td class="px-4 py-4">
                                        {{ $value['quantity'] }}
                                    </td>

                                    <td class="px-4 py-4">
                                        ₦{{ number_format($value['price'] * $value['quantity'], 2) }}
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        <form id="remove-item-{{ $key }}" action="{{ route('cart.delete', $key) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                onclick="removeItem('{{ $key }}')"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="border-t bg-gray-50 p-6">
                    <div class="max-w-md ml-auto space-y-3">

                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span id="cart-subtotal" class="font-medium">
                                ₦{{ number_format($subtotal, 2) }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">Delivery Fee</span>
                            <span id="delivery-fee" class="font-medium">
                                ₦{{ number_format($deliveryFee, 2) }}
                            </span>
                        </div>

                        <div class="border-t pt-3 flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span id="cart-total" class="font-bold text-green-600">
                                ₦{{ number_format($total, 2) }}
                            </span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex flex-col md:flex-row gap-4 justify-between">

                <a href="{{ route('menu') }}"
                   class="text-center bg-gray-700 hover:bg-gray-800 text-white px-6 py-3 rounded-lg">
                    Continue Shopping
                </a>

                <div class="flex flex-col sm:flex-row gap-3">

                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button
                            class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg">
                            Clear Cart
                        </button>
                    </form>

                    <a href="{{ route('checkout.index') }}"
                       class="text-center bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">
                        Proceed to Checkout
                    </a>

                </div>
            </div>

        @endif

    </div>
    <script>

        async function removeItem(key){
            event.preventDefault();
            
            try{
                const response= await fetch('{{route("cart.remove")}}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();

                if(response.ok && data.success){
                    alert('Item removed successfully');

                    console.log(data);
                    // Optionally, you can update the cart UI here without reloading
                    document.getElementById('cart-row-{{ $key }}').remove();

                    document.getElementById('cart-subtotal').textContent = `₦${data.subtotal}`;

                    document.getElementById('delivery-fee').textContent = `₦${data.deliveryFee}`;
                    document.getElementById('cart-total').textContent = `₦${data.total}`;
                    
                }else{
                    throw new Error(data.message || 'Failed to remove item');
                }

            }catch(error){
                console.error('Error removing item:', error);
            }

        }

    </script>
</body>
</html>