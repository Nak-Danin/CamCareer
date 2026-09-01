@props([
'badge', 'category_name', 'jobs_count'
])

<div class="flex flex-col items-center w-[140px] md:w-full md:justify-baseline gap-3 p-5 border border-gray-300 bg-white hover:border-blue-800 rounded group cursor-pointer">
    <i class="{{ $badge }} text-blue-800 bg-indigo-100 group-hover:bg-indigo-200 w-fit px-3 py-2 rounded"></i>
    <h1 class="text-lg md:text-2xl font-medium capitalize">{{ $category_name }}</h1>
    <span class="hidden md:block text-gray-500 font-medium">Available {{ $jobs_count }} Position{{$jobs_count > 1 ? 's':''}}</span>
</div>