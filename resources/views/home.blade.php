<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($records->hasPages())
                    <div class="p-3">
                        {{ $records->links() }}
                    </div>
                @endif
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse ($records as $key => $record)
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <img class="w-full h-48 object-cover object-center" src="{{ $record->image_url }}"
                                    alt="{{ $record->title }}">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-800">{{ $record->title }}</h2>
                                    <p class="mt-2 text-gray-600">{{ $record->description }}</p>
                                    <div class="mt-4 flex justify-between items-center">
                                        <div class="flex items
                                        -center">
                                            <p class="ml-2 text-sm text-gray-600">{{ $record->user->name }}</p>
                                        </div>
                                        <a href="{{ route('details', $record->slug) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Read more</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex justify-center items-center">
                                <span class="font-medium py-8 text-gray-400 text-xl">
                                    No data found...
                                </span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
