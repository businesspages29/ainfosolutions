<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Post') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('') }}
                            </p>
                        </header>
                        @if (!empty($record))
                            <form method="post" action="{{ route('posts.update', $record->id) }}" class="mt-6 space-y-6"
                                enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form method="post" action="{{ route('posts.store') }}" class="mt-6 space-y-6"
                                    enctype="multipart/form-data">
                        @endif
                        @csrf


                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <x-select name="category_id" :options="$categories" :selected="old('category_id', @$record->category_id)" />
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                :value="old('title', @$record->title)" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="content" :value="__('Content')" />
                            <x-textarea id="content" name="content" type="text" class="mt-1 block w-full"
                                :value="old('content', @$record->content)" required autofocus autocomplete="content" />
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>


                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select name="status" :options="$statuses" :selected="old('status', @$record->status)" />
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <div>
                            <x-input-label for="image" :value="__('Image')" />
                            <x-text-input type="file" id="image" name="image" class="mt-1 block w-full" />
                            @if (!empty($record) && $record->image)
                                <img src="{{ $record->image_url }}" alt="{{ $record->title }}"
                                    class="mt-2 w-20 h-20 object-cover" />
                            @endif
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
