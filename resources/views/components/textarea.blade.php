@props(['disabled' => false])

<textarea @if ($disabled) disabled @endif
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>{{ $attributes->get('value') }}</textarea>
