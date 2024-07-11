<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
        <a href="{{ route('permissions.index')}}" class="">Back</a>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <form action="{{ route('permissions.update', $permission->id) }}" method="post">
                    @csrf
                    <div>
                        <x-message></x-message>
                        <label class="font-medium text-lg ">Name:</label>
                        <div class="mb-3">
                            <input type="text" name="name" value="{{ $permission->name }}" class="border-grey w-1/2 rounded-lg" placeholder="Enter Name">
                            
                            <button class="bg-slate-700 text-sm rounded-md py-4">Update</button>
                            @error('name')
                            <p class="text-red-400">{{ $message}}</p>
                            @enderror
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
