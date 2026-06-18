<x-admin-layout>

        <div>
            <h2>Create Product</h2>
        </div>

        @if(session('success'))
            <div>{{session('success')}}</div>
        @endif
        @if(session('error'))
            <div>{{session('error')}}</div>
        @endif
        <div>
            <form id="productForm" action="{{route('product.store')}}" method="post" enctype="multipart/form-data" class="w-full max-w-xs">
                @csrf
                <div>
                    <select name="category_id" id="" required>
                        @foreach($category as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <div class="md:w-1/3">
                        <label for="name" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Product name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input type="text" name='name' id='name' value="{{old('name')}}" required 
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-grey-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    </div>
                </div>
                <div>
                    <div class="md:w-1/3">
                        <label for="price" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        Price
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input type="number" name="price" id="price" value="{{old('price')}}" required
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-grey-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    </div>
                </div>
                <div>
                    <div class="md:w-1/3">
                        <label for="quantity" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">Quantity</label>
                    </div>
                    <div class="md:w-2/3">
                        <input type="number" min="1" name="quantity" id="quantity" value="{{old('quantity')}}" required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-grey-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    </div>
                </div>
                <div>
                    <div class="md:w-1/3" >
                        <label for="is_available" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">Available?</label>
                    </div>
                    <div>
                        <select name="is_available" id="is_available">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    </div>
                    
                </div>
                <div>
                    <label for="image" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">Image</label>
                    <input type="file" name="image" id="image" required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-grey-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>

                <button style="background-color:green">Store</button>
            </form>
        </div>

<script>

    document.querySelector('form').addEventListener('submit', createProduct);
    
    async function createProduct(event){
        event.preventdefault();

        const form = document.querySelector('form');
        const formData = new FormData(this);

        try {
            const response = await fetch('form.action', {
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]').
                    getAttribute('content')
                },
                body: formData

            })
            const data= await response.json();
            if(data.success){
                console.log('Product added successfully', data.message);
                alert('Product added successfully');
            }
        }catch(error){
            console.error('Error:', error);
            alert('An error occurred while adding the product.');

        }
    }
</script>
</x-admin-layout>