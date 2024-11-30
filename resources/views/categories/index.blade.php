<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between pt-3 pb-3">
                <div class="w-1/4">

                </div>
                <x-primary-link href="{{ route('categories.create') }}" class="float-right">
                    {{ __('Add') }}
                </x-primary-link>
            </div>
            <x-tables.table>
                <x-slot name="header">
                    <x-tables.header>{{ __('No.') }}</x-tables.header>
                    <x-tables.header>{{ __('Name') }}</x-tables.header>
                    <x-tables.header>{{ __('Slug') }}</x-tables.header>
                    <x-tables.header>{{ __('Action') }}</x-tables.header>
                </x-slot>
                <x-slot name="body">
                    @forelse ($records as $key => $record)
                        <x-tables.row>
                            <x-tables.cell>{{ ++$i }}</x-tables.cell>
                            <x-tables.cell>{{ $record->name }}</x-tables.cell>
                            <x-tables.cell>{{ $record->slug }}</x-tables.cell>
                            <x-tables.cell class="text-center">
                                <form action="{{ route('categories.destroy', $record->id) }}" method="POST"
                                    class="flex gap-2">
                                    <x-primary-link
                                        href="{{ route('categories.show', $record->id) }}">Show</x-primary-link>
                                    <x-secondary-link
                                        href="{{ route('categories.edit', $record->id) }}">Edit</x-secondary-link>
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button class="ms-3" type="submit">
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                </form>
                            </x-tables.cell>
                        </x-tables.row>
                    @empty
                        <x-tables.row>
                            <x-tables.cell colspan=4>
                                <div class="flex justify-center items-center">
                                    <span class="font-medium py-8 text-gray-400 text-xl">
                                        No data found...
                                    </span>
                                </div>
                            </x-tables.cell>
                        </x-tables.row>
                    @endforelse
                </x-slot>
            </x-tables.table>
            @if ($records->hasPages())
                <div class="p-3">
                    {{ $records->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
