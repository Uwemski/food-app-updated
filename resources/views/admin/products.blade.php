<x-admin-layout>
    <div>
        @if(session('success'))
        <div style="color:green">{{session('success')}}</div>
    @endif

    <table border='1' class="w-full text-left">
        <thead class="bg-cream/60 border-b border-soft/15">
            <tr>
                <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">S/N</th>
                <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Name</th>
                <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Price</th>
                <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Quantity</th>
                <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Available</th>
                <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Action</th>
                <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Action</th>
            </tr>
        </thead>
        <tbody lass="divide-y divide-soft/10">
            @foreach($products as $product)
            <tr class="hover:bg-cream/40 transition-colors duration-200">
                <td>{{$loop->iteration}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->quantity}}</td>
                <td>
                    <form action="{{ route('product.updateAvailability', $product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <select name="is_available">
                            <option value="1" {{ $product->is_available ? 'selected' : '' }}>
                                Yes
                            </option>

                            <option value="0" {{ !$product->is_available ? 'selected' : '' }}>
                                No
                            </option>
                        </select>

                        <button type="submit">Update</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('product.updateQuantity', $product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input 
                            type="number"
                            name="quantity"
                            value="{{ $product->quantity }}"
                            min="0"
                        >

                        <button type="submit">Update</button>
                    </form>
                </td>
                <td>
                    <form  action="{{route('product.remove', $product->id)}}" method="post">
                        @csrf
                        <button>Delete</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('product.edit', $product->id)}}" method="post">
                        @csrf
                        <button class="px-5 py-3 rounded-2xl bg-gradient-to-r from-flame to-ember text-white font-semibold shadow-btn hover:shadow-btn-hover transition-all duration-200">Edit</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>


</x-admin-layout>