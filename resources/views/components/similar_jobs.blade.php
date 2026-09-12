@props([
'category'
])
@php
$jobs = $category->careers->take(4);
@endphp
<main class="flex flex-col gap-4">
    <h1 class="text-heading text-2xl">Similar Jobs</h1>
    @foreach ($jobs as $job)
    <div class="flex items-center gap-3">
        <i class="fi fi-rs-building text-2xl px-2 py-1 rounded border border-gray-300 bg-blue-100"></i>
        <div class="flex flex-col">
            <h1 class="font-medium">{{ $job->title }}</h1>
            <div class="flex items-center gap-1 text-sm font-medium text-gray-600">
                {{ $job->company->company_name }}
                <i class="fi fi-ss-circle-small text-[8px] text-green-600 mt-2"></i>
                {{ $job->location }}
            </div>
        </div>
    </div>
    @endforeach
    <button class="text-white bg-blue-800 md:bg-white md:text-blue-800 font-medium w-full text-center py-2 border-2 border-gray-300 rounded hover:bg-blue-800 hover:text-white transition-all cursor-pointer">Explore More Jobs</button>
</main>