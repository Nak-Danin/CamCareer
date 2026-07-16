<x-employer-layout heading=''>
    <div class="flex gap-2 items-center">
        <a href="{{ route('employer.candidates') }}" class="text-gray-800 text-base font-medium ">Candidates</a>
        <i class="fi fi-bs-greater-than text-[8px] text-gray-600 mt-1"></i>
        <a href="{{ route('employer.viewJob',['career' => $career->slug]) }}" class="font-medium">{{ $career->title }} </a>
        <i class="fi fi-bs-greater-than text-[8px] text-gray-600 mt-1"></i>
        <span class="text-blue-800 font-medium">Pipeline</span>
    </div>
    <x-job_heading :career="$career" />
    <div class="grid grid-cols-4 gap-4 w-full mb-5">
        <!-- Applied -->
        <x-candidates_list_preview title="applied" :applications="$applications->where('status', 'applied')" nextStatus="shortlisted" />
        <!-- Shortlisted -->
        <x-candidates_list_preview title="shortlisted" :applications="$applications->where('status', 'shortlisted')" nextStatus="interview" />
        <!-- Interview -->
        <x-candidates_list_preview title="interview" :applications="$applications->where('status', 'interview')" nextStatus="offered" />
        <!-- Offered -->
        <x-candidates_list_preview title="offer" :applications="$applications->where('status', 'offered')" nextStatus="" />
    </div>
</x-employer-layout>