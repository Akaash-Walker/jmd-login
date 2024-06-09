<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Hello,
                        @if (!str_contains($user->name, ' '))
                            {{ $user->name  }}
                        @else
                        {{ substr($user->name, 0, strpos($user->name, ' ')) }}
                        @endif
                    </h1>
                    <p>Welcome back to your dashboard.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="flex-1 m-0 p-0">
            <div class="py-0">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <form method="post" action="{{ route('saveItem') }}" accept-charset="UTF-8"
                          class="max-w-lg mx-auto p-4 border rounded-lg bg-white shadow-md">
                        {{ csrf_field() }}
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Add a todo</label>
                            <input type="text" id="name" name="name" required
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <x-primary-button>{{ __('Submit') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
        <div class="flex-1 m-0 p-0">
            <div class="py-0">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="max-w-lg mx-auto p-4 border rounded-lg bg-white shadow-md">
                        <label for="name" class="block text-gray-700 text-lg font-bold mb-2">Things to do</label>
                        @if(count($listItems) == 0)
                            <p>Nothing!</p>
                        @endif
                        @foreach($listItems as $listItem)
                            <div class="mb-4 flex justify-between items-center">
                                <p class="text-gray-700">{{ $listItem->name }}</p>
                                <form method="POST" action="{{ route('dashboard.delete', $listItem->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button>{{ __('Delete') }}</x-primary-button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
