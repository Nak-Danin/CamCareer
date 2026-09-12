@props([
'title', 'value'
])

<main class="w-full bg-white p-4 rounded-md">
    <h1>{{ $title }}</h1>
    <span class="text-xl capitalize">{{ $value }}</span>
</main>