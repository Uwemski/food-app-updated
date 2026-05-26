<x-admin-layout>

    <x-slot name="header">
        <div>Orders</div>
</x-slot>

     <div>
        @if(session('p-success'))
            <div style='color:green'>{{session('p-success')}}</div>
        @endif

        @if(session('status_success'))
            <div style='color:green'>{{session('status_success')}}</div>
        @endif
        
        <table border='1' class="w-full text-left">
            <thead class="bg-cream/60 border-b border-soft/15">
                <tr>
                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">S/N</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Customer name</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Total</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Transaction reference</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Payment Status</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Delivery status</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Created At</th>
                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-soft/10">
                @foreach($orders as $order)
                <tr class="hover:bg-cream/40 transition-colors duration-200">
                    <td class="px-6 py-5 font-semibold text-charcoal">{{$loop->iteration}}</td>
                    <td class="px-6 py-5 text-muted">{{$order->customer_name}}</td>
                    <td class="px-6 py-5 text-muted">₦{{$order->total_amount}}</td>
                    <td class="px-6 py-5 font-semibold text-charcoal">{{$order->transaction_ref}}</td>
                    <td>
                        <form action="{{route('payment.update', $order)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="payment_status" id="">
                                <option value="pending" {{$order->payment_status === 'pending' ? 'selected': '' }}>Pending</option>
                                <option value="paid" {{$order->payment_status === 'paid' ? 'selected' : ''}}>Paid</option>
                                <option value="failed" {{$order->payment_status === 'failed' ? 'selected' : ''}}>Failed</option>
                            </select>
                            <button>Update</button>
                        </form>

                    </td>
                    <td class="px-6 py-5> 
                        <form action="{{route('status.update', $order->id)}}" method="post">
                            @csrf
                            @method('PATCH')
                            <select name="status" id="">
                                <option value="pending" {{$order->status === "pending"? 'selected' : ''}} class="px-3 py-1 rounded-full text-xs font-semibold bg-amber/15 text-amber">Pending</option>
                                <option value="confirmed" {{$order->status === "confirmed" ? 'selected' : ''}}>Confirmed</option>
                                <option value="preparing" {{$order->status === "preparing" ? 'selected' : ''}} class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Preparing</option>
                                <option value="delivered" {{$order->status === "delivered" ? 'selected' : ''}} class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Delivered</option>
                                <option value="cancelled" {{$order->status === "cancelled" ? 'selected' : ''}} class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-blue-700">Canceled</option>
                            </select>
                                <button>Update</button>
                        </form>
                    </td>
                    <!-- either use diffForHumans() or format('d/m/Y') -->
                    <td>{{$order->created_at->diffForHumans()}}</td>
                    <td><a href="{{route('orders.show', $order)}}">view</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>