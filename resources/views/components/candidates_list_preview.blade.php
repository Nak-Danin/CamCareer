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
    <section class="ui-card flex flex-col gap-5">
        <div class="flex gap-2">
            <img class="w-[50px] h-[50px] rounded-xl border border-gray-200" src="{{ $candidate->profile ? Storage::url($candidate->profile) : Vite::asset('resources/images/image.png') }}" alt="Profile">
            <section class="flex flex-col gap-1 font-medium">
                <span>{{ $candidate->first_name }} {{ $candidate->last_name }}</span>
                <a target="_blank" class="text-sm text-blue-700" href="{{ $candidate->resume_url }}">View Resume</a>
            </section>
        </div>
        <div class="text-gray-700 font-medium text-[14px] flex gap-2 border-b-2 border-gray-300 pb-2 overflow-x-hidden">
            <button
                onclick="copyEmail('{{ $candidate->user->email }}')"
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
            {{ $candidate->user->email }}
        </div>
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

    <script>
        function copyEmail(email) {
            navigator.clipboard.writeText(email);
            alert('Email copied!');
        };
    </script>
</main>