@props([
'career'
])
<main class="flex flex-col gap-2">
    <div class="flex items-center gap-4">
        <div class="flex gap-4 items-center">
            <i class="{{ $career->category->icon }} text-2xl text-blue-800 bg-blue-200 px-2 pt-1 rounded-md"></i>
            <h1 class="text-heading">{{ $career->title }}</h1>
        </div>
        @if ($career->status === 'available')
        <span class="text-sm h-fit text-green-600 bg-green-200 rounded px-2 font-medium uppercase">Available</span>
        @else
        <span class="text-sm h-fit text-red-600 bg-red-200 rounded px-2 font-medium uppercase">Unavailable</span>
        @endif
    </div>
    @can('viewAny', \App\Models\Career::class)
    <div class="flex gap-2 text-md text-blue-800 font-medium">
        <i class="fi fi-rs-building"></i>
        <h1>{{ $career->company->company_name }}</h1>
    </div>
    @endcan
    <div class="flex gap-4 items-center text-gray-700">
        <span><i class="fi fi-rs-marker"></i> {{ $career->location }}</span>
        <i class="fi fi-ss-circle text-[8px] mt-1 text-green-500"></i>
        <span>Posted {{$career->created_at->diffForHumans()}}</span>
    </div>
</main>