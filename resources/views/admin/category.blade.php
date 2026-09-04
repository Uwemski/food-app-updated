<x-admin-layout>

    @if(session('success'))
        <div class="text-green-500">
            <p>{{session('success')}}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="text-red-500">
            <p>{{session('error')}}</p>
        </div>
    @endif

    <table border='1' class="w-full text-left">
        <thead class="bg-cream/60 border-b border-soft/15">
            <tr>
                <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">s/n</th>
                <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Name</th>
                <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">created at</th>
                <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-soft/10">
            @foreach($categories as $category)
            <tr class="hover:bg-cream/40 transition-colors duration-200">
                <td class="px-6 py-5 text-muted"> {{$loop->iteration}}</td>
                <td class="px-6 py-5 font-semibold text-charcoal">{{$category->name}}</td>
                <td class="px-6 py-5 text-muted">{{$category->created_at->format('Y-m-d')}}</td>
                <td>
                    <form action="{{route('category.destroy', $category->id)}}" method='POST'>
                        @csrf
                        @method('delete')
                        <button class='text-red-500'>Delete</button>
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
     
</x-admin-layout>