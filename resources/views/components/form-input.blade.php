@props(['label', 'value' => ''])

<div class="mb-4">
    <label class="block font-medium text-sm text-gray-700 mb-1">{{ $label }}</label>
    <input 
        {{ $attributes->merge(['class' => 'border rounded px-3 py-2 w-full focus:ring focus:ring-blue-200']) }} 
        value="{{ old($attributes->get('name'), $value) }}"
    >
    @error($attributes->get('name'))
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>
    