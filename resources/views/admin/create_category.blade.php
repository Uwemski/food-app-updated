<x-admin-layout>

<div style='text-transform:uppercase; font-weight:bold'>
        Create Category
    </div>

    @if(session('success'))
        <div style="color:green">{{session('success')}} </div>
    @endif
    @if(session('error'))
        <div style="color:red">{{session('error')}} </div>
    @endif

    <div class="">
        <form action="{{route('category.store')}}" method="post">
            @csrf
            <div class="">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{old('name')}}">
            </div>
            @error('name')
                <small>{{message}}</small>
            @enderror
            <div>
                <button type="button" onclick="createCategory()">Create</button>
            </div>
        </form>
    </div>

<script>
    async function createCategory(){
        try{
            const response= await fetch('{{route('category.store')}}', {
                'method': 'POST',
                'headers': {
                    'content-type': 'application/json',
                    'x-csrf-token': '{{csrf_token()}}'
                },
                'body': JSON.stringify({
                    'name': document.getElementById('name').value
                })
            })
            const data = response.json();
            if(data.response.ok && data.success){
                alert('Category created successfully');
                console.log('Category created successfully', data.message);
            }else{
                alert('Error creating category:' + data.message);
                console.error('Error creating category:', data.message);
            }
        }catch(error){
            console.error('Error creating category:', error);
        }
    }
</script>
</x-admin-layout>