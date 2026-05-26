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
                <button>Create</button>
            </div>
        </form>
    </div>


</x-admin-layout>