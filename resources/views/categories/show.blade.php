<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Category') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('') }}
                                </p>
                            </header>
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <p>{{ $record->name }}</p>
                            </div>
                            <div>
                                <x-input-label for="slug" :value="__('Slug')" />
                                <p>{{ $record->slug }}</p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
