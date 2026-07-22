<x-employer-layout heading=''>
    <div class="flex gap-4 items-center">
        <h1 class="text-heading">Upcoming Interviews</h1>
        <span class="text-count mt-2">{{ $interviews_count }}</span>
    </div>
    <h1 class="text-description">Manage and track candidates who have been scheduled for interviews.</h1>
    <main class="flex flex-col gap-8 pb-8">
        @foreach ($careers as $career)
        @php
        $interview_count = $career->applications->count();
        @endphp
        @if($interview_count > 0)
        <section class="flex flex-col gap-2">
            <div class="flex gap-5 items-center">
                <a href="{{ route('employer.candidates.show',['career' => $career->slug]) }}" class="text-heading text-2xl">{{ $career->title }}</a>
                <span class="text-count">{{ $interview_count }}</span>
            </div>
            <div class="grid grid-cols-3 gap-10">
                @foreach ($career->applications as $application)
                <x-interview_card :application='$application' />
                @endforeach
            </div>
        </section>
        @endif
        @endforeach
    </main>
</x-employer-layout>