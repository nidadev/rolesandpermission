<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role Listing') }}
        </h2>
        <a href="{{ route('role.create')}}" class="">Create</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <x-message></x-message>
                
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
