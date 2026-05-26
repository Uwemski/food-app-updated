<x-admin-layout>

<div>
            Create Product
        </div>

        @if(session('success'))
            <div>{{session('success')}}</div>
        @endif
        @if(session('error'))
            <div>{{session('error')}}</div>
        @endif
        <div>
            <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <select name="category_id" id="" required>
                        @foreach($category as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="product">Product name</label>
                    <input type="text" name='name' id='product' value="{{old('name')}}" required>
                </div>
                <div>
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" value="{{old('price')}}" required>
                </div>
                <div>
                    <label for="">Quantity</label>
                    <input type="number" min:0 name="quantity" id="quantity" value="{{old('quantity')}}" required>
                </div>
                <div>
                    <label for="">Available?</label>
                    <select name="is_available" id="">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div>
                    <label for=""></label>
                    <input type="file" name="image">
                </div>

                <button style="background-color:green">Store</button>
            </form>
        </div>


</x-admin-layout>