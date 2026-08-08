@props([
'label' => null,
'name',
'type' => 'text',
'value' => ''
])

<div class="flex flex-col gap-1.5 w-full">
    @if($label)
    <label for="{{ $name }}" class="text-sm font-medium text-slate-700">
        {{ $label }}
    </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->merge([
            'class' => 'w-full px-3 py-2 border border-gray-100 bg-gray-100/60 rounded-md text-sm transition-colors focus:outline-none focus:ring-2 ' . 
            ($errors->has($name) 
                ? 'border-red-500 focus:border-red-500 focus:ring-red-200' 
                : 'border-slate-300 focus:border-indigo-500 focus:ring-indigo-100')
        ]) }} />

    @error($name)
    <span class="text-xs text-red-600 font-medium">
        {{ $message }}
    </span>
    @enderror
</div>