@props([
'application'
])

@php
use Carbon\Carbon;
$interview = $application->interview;
$interview_date = Carbon::parse($application->interview->interview_date)->format('jS F, Y');
$interview_time = $application->interview->interview_time;
$time_format = Carbon::parse($application->interview->interview_time)->format('A');
$interview_location = $application->interview->location;
@endphp

<section class="ui-card flex flex-col gap-5 py-5 relative">
    @if ($application->interview->status === 'rescheduled')
    <span class="absolute right-0 top-5 bg-amber-400 text-amber-800 font-medium h-fit px-3 py-1 rounded-l-xl [clip-path:polygon(10%_0,_100%_0%,_100%_100%,_10%_100%,_0%_50%)]">Rescheduled</span>
    @endif
    <section class="flex justify-between">
        <div class="flex gap-2">
            <img class="w-[50px] h-[50px] rounded-xl border border-gray-200" src="{{ $application->seeker->profile ? Storage::url($application->seeker->profile) : Vite::asset('resources/images/image.png') }}" alt="Profile">
            <section class="flex flex-col gap-1 font-medium">
                <span>{{ $application->seeker->first_name }} {{ $application->seeker->last_name }}</span>
                <a target="_blank" class="text-sm text-blue-700" href="{{ $application->seeker->resume_url }}">View Resume</a>
            </section>
        </div>
    </section>
    <div class="text-gray-700 font-medium text-[14px] flex gap-2 border-b-2 border-gray-300 pb-2 overflow-x-hidden">
        <button
            onclick="copyEmail('{{ $application->seeker->user->email }}')"
            class="text-gray-500 hover:text-blue-600 transition"
            title="Copy email">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-4 h-4">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125H5.25a1.125 1.125 0 0 1-1.125-1.125V7.5c0-.621.504-1.125 1.125-1.125h3.375m6.375-3.375h4.5c.621 0 1.125.504 1.125 1.125V15c0 .621-.504 1.125-1.125 1.125H10.5A1.125 1.125 0 0 1 9.375 15V4.125C9.375 3.504 9.879 3 10.5 3Z" />
            </svg>
        </button>
        {{ $application->seeker->user->email }}
    </div>
    <div class="flex flex-col gap-1 font-medium text-gray-700">
        <h1 class="uppercase text-[15px] text-blue-800">Interview Schedule: </h1>
        <div class="flex justify-between">
            <div class="flex flex-col gap-1">
                <span>{{ $interview_date }}</span>
                <span>at {{ $interview_time }} {{ $time_format }}</span>
            </div>
            <span class="text-heading text-sm">
                <i class="fi fi-rr-land-layer-location"></i>
                {{ $interview_location }}
            </span>
        </div>
        <div class="flex justify-between items-center mt-3">
            <span class="flex justify-end text-[12px] uppercase">Applied {{ $application->created_at->diffForHumans() }}</span>
            <a href="{{ route('employer.interview.edit', ['interview' => $interview]) }}" class="py-1 text-blue-800 underline underline-offset-2"> Reschedule</a>
        </div>
        <div class="flex justify-between mt-3">
            <form action="{{ route('employer.interview.cancel', ['interview'=>$application->interview]) }}" method="post">
                @csrf @method('PATCH')
                <button type="submit" class="btn-danger flex items-center gap-2 px-2 py-1 font-normal border-2 border-gray-300">
                    <i class="fi fi-sr-trash"></i>
                    Cancel
                </button>
            </form>
            <form action="{{ route('employer.interview.complete', ['interview'=>$application->interview]) }}" method="post">
                @csrf @method('PATCH')
                <button type="submit" class="btn-success py-1 flex gap-1 px-2 items-center p-4 font-normal border-2 border-gray-300 w-full"><i class="fi fi-bs-octagon-check"></i>Complete</button>
            </form>
        </div>
    </div>
    <script>
        function copyEmail(email) {
            navigator.clipboard.writeText(email);
            alert('Email copied!');
        };
    </script>
</section>