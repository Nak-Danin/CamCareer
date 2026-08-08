@props(['active' => false])

@php
// If active is true, use the bold white text, otherwise use muted text
$classes = 'px-4 py-3 h-full rounded-md font-medium transition transition duration-150 ease-in-out ' .
($active
? 'text-blue-800 bg-white border border-gray-200 p-2'
: 'text-gray-700 hover:text-blue-800 hover:bg-gray-200');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>