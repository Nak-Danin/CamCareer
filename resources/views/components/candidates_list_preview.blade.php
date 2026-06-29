@props([
'applications', 'title', 'career', 'nextStatus'
])

<main class="flex flex-col gap-3 w-full border-r-2 pe-3 border-gray-300">
    <section class="flex gap-4 items-center font-medium">
        <span class="text-lg uppercase">{{ $title }}</span>
        <span class="bg-gray-300 h-fit px-3 py-1 rounded-lg text-sm">{{ $applications->count() }}</span>
    </section>
    @foreach ($applications as $application)
    @php $candidate = $application->seeker @endphp
    <section class="ui-card flex flex-col gap-5 w-full">
        <div class="flex gap-2">
            <img class="w-[50px] h-[50px] rounded-xl border border-gray-200" src="{{ $candidate->profile ? Storage::url($candidate->profile) : Vite::asset('resources/images/image.png') }}" alt="Profile">
            <section class="flex flex-col gap-1 font-medium">
                <span>{{ $candidate->first_name }} {{ $candidate->last_name }}</span>
                <a target="_blank" class="text-sm text-blue-700" href="{{ $candidate->resume_url }}">View Resume</a>
            </section>
        </div>
        <h1 class="text-gray-700 font-medium border-b-2 border-gray-300 pb-2">Tel: {{ $candidate->phone }}</h1>
        <div class="flex justify-between">
            <span class="uppercase text-sm font-medium text-gray-700">Applied {{ $application->created_at->diffForHumans() }}</span>
        </div>
        @if ($nextStatus !== '')
        <div class="flex justify-between items-center">
            <form action="{{ route('employer.application.update_status', ['application' => $application, 'status' => 'rejected']) }}"
                method="post">
                @csrf @method('PATCH')
                <button type="submit" class="btn-danger text-sm uppercase py-1">Reject</button>
            </form>
            <form action="{{ route('employer.application.update_status', ['application' => $application, 'status' => $nextStatus]) }}"
                method="post">
                @csrf @method('PATCH')
                <button @disabled($application->career->status === "unavailable") type="submit" class="btn-primary text-sm uppercase py-1 disabled:cursor-not-allowed">Next</button>
            </form>
        </div>
        @else
        <h1 class="rounded-md bg-green-400/90 text-green-700 font-medium py-1 text-center">Offered</h1>
        <form action="{{ route('employer.application.revoke_offer', ['application' => $application]) }}" method="post">
            @csrf @method('PATCH')
            <button type="submit" class="btn-danger text-sm uppercase py-2 w-full">Revoke Offer</button>
        </form>
        @endif

    </section>
    @endforeach
</main>