@props([
'badge', 'categoryName', 'jobs_count'
])

<a {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center w-[140px] md:w-full md:items-baseline text-lg gap-3 p-5 border border-gray-300 bg-white hover:border-blue-800 rounded group cursor-pointer']) }}>
    <i class="{{ $badge }} text-blue-800 bg-indigo-100 group-hover:bg-indigo-200 w-fit px-3 py-2 rounded text-lg"></i>
    <h1 class="md:text-2xl font-medium">{!! $categoryName !!}</h1>
    <span class="hidden md:block text-gray-500 font-medium text-sm">Available {{ $jobs_count }} Position{{$jobs_count > 1 ? 's':''}}</span>
</a>