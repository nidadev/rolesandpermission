<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
        <a href="{{ route('role.index')}}" class="">Back</a>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <form action="{{ route('role.store') }}" method="post">
                    @csrf
                    <div>
                        <label class="font-medium text-lg ">Name:</label>
                        <div class="mb-3">
                            <input type="text" name="name" class="border-grey w-1/2 rounded-lg" placeholder="Enter Name">
                            @error('name')
                            <p class="text-red-400">{{ $message}}</p>
                            @enderror
                            <div class="grid grid-cols-4">
                                @if($permissions->isNotEmpty())
                                @foreach($permissions as $permission)
                                <div class="mt-4">
                                    <input type="checkbox" id="permission-{{ $permission->id}}" class="rounded" name="permission[]" value="{{ $permission->name}}">
                                {{ $permission->name}}
                                </div>
                                @endforeach
                                @endif

                        </div>
                            <button class="bg-slate-700 text-sm rounded-md py-4 px-5 text-white">Save</button>
                           
                        </div>
                        
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
