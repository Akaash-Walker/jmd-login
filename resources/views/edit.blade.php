<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Hello,
                    @if (!str_contains($user->name, ' '))
                        {{ $user->name }}
                    @else
                        {{ substr($user->name, 0, strpos($user->name, ' ')) }}
                    @endif
                </h1>
                <p>Welcome back to your dashboard.</p>
            </div>
        </div>

        <div class="flex space-x-4 mt-6">
            <div class="w-full p-4 border rounded-lg bg-white shadow-md">
                <form method="post" action="{{ route('dashboard.store') }}" accept-charset="UTF-8">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Add a todo</label>
                        <input type="text" id="name" name="name" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <x-primary-button>{{ __('Submit') }}</x-primary-button>
                </form>
            </div>

            <div class="w-full p-4 border rounded-lg bg-white shadow-md">
                <label for="name" class="block text-gray-700 text-lg font-bold mb-2">Things to do</label>
                @foreach ($listItems as $listItem)
                    <div class="mb-4 flex justify-between items-center">
                        <form method="POST" action="{{ route('dashboard.update', $listItem->id) }}"
                            class="flex items-center">
                            @csrf
                            @method('PATCH')
                            @if ($listItem->id == $listItemToUpdate->id)
                                <input type="text" id="name" name="name" value="{{ $listItem->name }}"
                                    required
                                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    style="width: 200px;">
                                <div class="ml-2 flex space-x-2">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                                    <x-button-link class="!bg-gray-600"
                                        href="{{ route('dashboard') }}">{{ __('Cancel') }}</x-button-link>
                                </div>
                            @else
                                <p class="text-gray-700">{{ $listItem->name }}</p>
                            @endif
                        </form>
                        <form method="POST" action="{{ route('dashboard.destroy', $listItem->id) }}">
                            @csrf
                            @method('DELETE')
                            <x-primary-button>{{ __('Delete') }}</x-primary-button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
