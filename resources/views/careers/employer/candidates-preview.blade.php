<x-employer-layout heading="Candidates Status">
    <h1 class="text-description">Manage each candidate's status for the following job posts.</h1>
    <ul class="flex flex-col gap-2">
        @foreach ($careers as $career)
        <a href="{{ route('employer.candidates.show', ['career' => $career->slug]) }}">
            <li class="flex justify-between p-3 list">
                <div class="flex flex-col gap-2">
                    <div class="flex gap-4 items-baseline font-medium ">
                        <span class="text-xl">{{ $career->title }}</span>
                        <i class="fi fi-ss-circle text-[9px] text-green-600"></i>
                        <span class="text-description text-sm">Posted {{ $career->created_at->diffForHumans() }}</span>
                    </div>
                    <span class="text-description text-base">
                        {{ $career->location }} ~ {{ $career->career_type }}
                    </span>
                </div>
                <div class="flex flex-col justify-between">
                    @if ($career->status === 'available')
                    <span class="text-sm h-fit text-green-600 rounded px-2 font-medium uppercase">Available</span>
                    @else
                    <span class="text-sm h-fit text-red-600 rounded px-2 font-medium uppercase">Unavailable</span>
                    @endif
                    <span class="text-gray-600 font-medium">{{ $career->applications->count() }} application(s)</span>
                </div>
            </li>
        </a>
        @endforeach
    </ul>
</x-employer-layout>