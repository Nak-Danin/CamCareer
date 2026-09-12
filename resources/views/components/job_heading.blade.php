@props([
'career'
])
@php
$seeker = Illuminate\Support\Facades\Auth::user()->seeker;
$isAlreadyApplied = $seeker->applications()->where('career_id', $career->career_id)->exists();
@endphp
<main class="flex flex-col gap-2 bg-white md:bg-transparent p-5 md:p-0 border-2 md:border-0 border-gray-300 rounded-md">
    <div class="flex items-center gap-4">
        <div class="flex flex-col md:flex-row gap-4 items-baseline md:items-center">
            <div class="md:hidden flex justify-between items-center w-full">
                <i class="{{ $career->category->icon }} text-4xl md:text-2xl w-fit md:w-full text-blue-800 bg-blue-200 px-2 py-1 md:py-0 pt-1 rounded-md"></i>
                @if (!$isAlreadyApplied)
                <form action="{{ route('application.store', ['career' => $career]) }}" method="POST">
                    @csrf @method("PATCH")
                    <button class="bg-blue-800 rounded-md text-white font-medium px-6 py-2 cursor-pointer" type="submit"> Apply Now </button>
                </form>
                @else
                <button class="bg-green-200 rounded-md text-green-600 font-medium px-9 py-2"> Applied </button>
                @endif
            </div>
            <i class="hidden md:block {{ $career->category->icon }} text-2xl text-blue-800 bg-blue-200 px-2 pt-1 rounded-md"></i>
            <h1 class="text-2xl text-heading md:text-3xl">{{ $career->title }}</h1>
        </div>
        @if ($career->status === 'available')
        <span class="hidden md:block text-sm h-fit text-green-600 bg-green-200 rounded px-2 font-medium uppercase">Available</span>
        @else
        <span class="hidden md:block text-sm h-fit text-red-600 bg-red-200 rounded px-2 font-medium uppercase">Unavailable</span>
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