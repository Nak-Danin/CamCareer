<x-employer-layout heading=''>
    <div class="flex items-center justify-between mb-2">
        <div class="flex gap-4 items-center">
            <h1 class="text-heading">
                {{ request('type') === 'past' ? 'Past Interviews' : 'Upcoming Interviews' }}
            </h1>
            <span class="text-count mt-2">{{ $interviews_count }}</span>
        </div>

        {{-- Interview Type Filter Dropdown --}}
        <div>
            <select 
                onchange="window.location.href = this.value" 
                class="rounded-md shadow-sm text-md py-2 px-2 text-gray-600 font-medium"
            >
                <option 
                    value="{{ request()->fullUrlWithQuery(['type' => 'upcoming']) }}" 
                    {{ request('type', 'upcoming') === 'upcoming' ? 'selected' : '' }}
                >
                    Upcoming Interviews
                </option>
                <option 
                    value="{{ request()->fullUrlWithQuery(['type' => 'past']) }}" 
                    {{ request('type') === 'past' ? 'selected' : '' }}
                >
                    Past Interviews
                </option>
            </select>
        </div>
    </div>

    <h1 class="text-description mb-6">
        {{ request('type') === 'past' ? 'View and review candidate interviews that have already taken place.' : 'Manage and track candidates who have been scheduled for interviews.' }}
    </h1>

    @if($careers->count() > 0)
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
    @else
    <span class="text-lg text-gray-600 border-t-2 border-gray-500 pt-8">
        {{ request('type') === 'past' ? "There's no record of any past interview" : "Currently, there's no record of any upcoming interview" }}
    </span>
    @endif
</x-employer-layout>