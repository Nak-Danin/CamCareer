@props([
'job', 'seeker'
])

@php
use Illuminate\Support\Str;
$salary_range = "Negotiable";
if($job->salary_range !== "Negotiable"){
[$minSalary, $maxSalary] = explode(' - ', $job->salary_range);
$salary_range = "$" . $minSalary . " - " . "$" . $maxSalary;
}
$isAlreadyApplied = $seeker->applications()->where('career_id', $job->career_id)->exists();
@endphp
<a href="{{ route('seeker.viewJob', ['career' => $job]) }}" class="flex flex-col gap-4 md:gap-2 border-2 border-gray-300 bg-white rounded p-4 hover:border-blue-600 cursor-pointer group">
    <div class="md:hidden flex items-center gap-4">
        <img class="w-[60px] h-[60px] border-2 border-gray-200 object-cover rounded-lg" src="{{ $job->company->logo_url ? Storage::url($job->company->logo_url) : Vite::asset('resources/images/image.png') }}" alt="Company Logo">
        <div class="flex flex-col gap-2 md:hidden">
            <span class="text-[14px]"><i class="fi fi-rs-building text-blue-800"></i> {{ $job->company->company_name }}</span>
            <span class="text-[14px]"><i class="fi fi-rs-marker text-red-700"></i> {{ $job->location }}</span>
        </div>
    </div>
    <div class="flex justify-between items-center gap-4">
        <div class="flex gap-3">
            <h1 class="text-heading text-xl group-hover:text-blue-800">{{ $job->title }}</h1>
            <span class="hidden md:flex text-description text-xs capitalize text-blue-800 px-2 py-1 h-fit bg-indigo-100 justify-center items-center font-medium rounded">{{ $job->career_type }}</span>
        </div>
        @if (!$isAlreadyApplied)
        <form class="hidden md:block" action="{{ route('application.store', ['career' => $job]) }}" method="POST">
            @csrf @method("PATCH")
            <button class="bg-blue-800 rounded-md text-white font-medium px-6 py-2 cursor-pointer" type="submit"> Apply Now </button>
        </form>
        @else
        <button class="hidden md:block bg-green-200 rounded-md text-green-600 font-medium px-9 py-2"> Applied </button>
        @endif
    </div>
    <div class="flex items-center justify-between">
        <div class="flex gap-4 items-center text-gray-700">
            <span class="hidden md:block"><i class="fi fi-rs-building text-blue-800"></i> {{ $job->company->company_name }}</span>
            <span class="hidden md:block"><i class="fi fi-rs-marker text-red-700"></i> {{ $job->location }}</span>
            <span><i class="fi fi-rr-payroll-check text-green-600"></i> {{ $salary_range }}</span>
            <span class="md:hidden text-description text-sm capitalize text-blue-800 px-4 py-1 bg-indigo-100 flex justify-center items-center font-medium rounded">{{ $job->career_type }}</span>
        </div>
        <div class="hidden md:flex gap-2 items-center">
            <i class="fi fi-ss-circle text-[8px] mt-1 text-green-500"></i>
            <span>Posted {{$job->created_at->diffForHumans()}}</span>
        </div>
    </div>
    @if (!$isAlreadyApplied)
    <form class="md:hidden" action="{{ route('application.store', ['career' => $job]) }}" method="POST">
        @csrf @method("PATCH")
        <button class="bg-blue-800 rounded-md text-white font-medium px-6 py-2 cursor-pointer w-full" type="submit"> Apply Now </button>
    </form>
    @else
    <button class="md:hidden bg-green-200 rounded-md text-green-600 font-medium px-9 py-2"> Applied </button>
    @endif
</a>