<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('To Do List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <h3 class="text-2xl">What would you like to do today?</h3>
                    <form action="{{ route('jeff-todo.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input name="name" placeholder="learn to fly..." class="rounded-md w-60" />
                        <x-primary-button>Add Todo</x-primary-button>
                    </form>
                </div>
            </div>
            @foreach ($todos as $todo)
                <div
                    class="flex items-center justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 p-6 text-gray-900">
                    <span>{{ $todo->name }}</span>
                    <form action="{{ route('jeff-todo.destroy', $todo->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <x-primary-button>Delete</x-primary-button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
