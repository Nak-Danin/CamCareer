@props([
'title', 'value'
])

<main class="w-full bg-white md:bg-[#f3f3fd] p-4 rounded-md">
    <span class="text-gray-600">{{ $title }}</span>
    <h1 class="text-xl capitalize">{{ $value }}</h1>
</main>