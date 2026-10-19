@props(['active' => false])

@php
// If active is true, use the bold white text, otherwise use muted text
$classes = 'px-3 py-2 h-full rounded-md text-l font-medium transition transition duration-150 ease-in-out ' .
($active
? 'text-blue-800 underline decoration-blue-800 md:underline-offset-22 underline-offset-8'
: 'text-gray-700 hover:text-blue-800');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>