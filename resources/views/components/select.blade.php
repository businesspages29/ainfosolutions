@props([
    'options' => [], // Array of options in the format ['value' => 'label']
    'selected' => null, // Selected value
    'disabled' => false, // Disable the select element
])

<select @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" @selected($value == $selected)>{{ $label }}</option>
    @endforeach
</select>
