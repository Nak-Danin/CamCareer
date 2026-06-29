@props([
'title', 'value'
])

<main class="w-full bg-[#f3f3fd] p-4 rounded-md">
    <h1>{{ $title }}</h1>
    <span class="text-xl capitalize">{{ $value }}</span>
</main>