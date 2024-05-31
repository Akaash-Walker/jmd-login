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
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
   {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="post" action="{{ route('saveItem') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <label for="listItem">New Todo</label> <br>
                    <input type="text" name="listItem"><br>
                    <button type="submit">Save Item</button>
                </form>
            </div>
        </div>
    </div>--}}
</x-app-layout>
