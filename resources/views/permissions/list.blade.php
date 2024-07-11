<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission Listing') }}
        </h2>
        <a href="{{ route('permissions.create')}}" class="">Create</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <x-message></x-message>
                  <table class="w-full">
                    <thead class="bg-grey-50">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($permissions->isNotEmpty())
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id}}</td>
                            <td>{{ $permission->name}}</td>
                            <td> {{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}</td>
                            <td><a href="{{route('permissions.edit',$permission->id)}}">Edit</a></td>
                            <td><a href="javascript:void(0);" onclick="deletePermission('{{ $permission->id }}')">Delete</a></td>

                        </tr>
                        @endforeach
                        @endif
                       
                    </tbody>
                  </table>
                  {{ $permissions->links()}}
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deletePermission(id)
            {
                if(confirm("Are you sure you want to delete?"))
                {
                    alert(id);
                    $.ajax(
                        {
                            url:'{{ route("permissions.delete") }}',
                            type : 'delete',
                            data:{id:id},
                            dataType: 'json',
                            headers: {
                            'x-csrf-token' : '{{ csrf_token() }}',
                            },
                            success:function(response)
                            {
                                window.location.href = '{{ route("permissions.index")}}';

                            }
                        });
                }

            }
            </script>
    </x-slot>
</x-app-layout>
