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
            <!-- id should be here to target this row below -->
            <tr class="hover:bg-cream/40 transition-colors duration-200" id="category-{{$category->id}}">
                <td class="px-6 py-5 text-muted"> {{$loop->iteration}}</td>
                <td class="px-6 py-5 font-semibold text-charcoal">{{$category->name}}</td>
                <td class="px-6 py-5 text-muted">{{$category->created_at->format('Y-m-d')}}</td>
                <td>
                    <form action="{{route('category.destroy', $category->id)}}" method='POST'>
                        @csrf
                        @method('delete')
                        <button class='text-red-500' 
                            onclick="deleteResource(
                                {{ $category->id }},
                                '{{ route('category.destroy', $category->id) }}'
                            )">
                            Delete
                        </button>
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
     <script>
        async function deleteResource(categoryId){
            try{
                // hopefully this doe it
                const response = await fetch(`{{route('category.destroy', $category->id')}}`, {
                    method: 'DELETE',
                    header: {
                        'Content-type' : 'application/json',
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                })

                if(!response.ok){
                    throw new Error('Failed to delete the resource');
                }

                const data = await response.json();
                console.log(data.message)
                const row = document.getElementById(`category-${$categoryId}`).remove();
                if(row){
                    row.remove
                }
            }catch(error){
                console.error('Error:', error)
            }
        }
     </script>
</x-admin-layout>