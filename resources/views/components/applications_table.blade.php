@props([
'applications'
])

<main class="bg-white py-6 rounded-xl shadow-sm border border-gray-200">
    <section class="flex flex-col gap-4">
        <div class="flex justify-between items-center px-8">
            <aside class="flex flex-col">
                <h1 class="text-heading text-2xl">Recent Applications</h1>
                <span class="text-gray-500 text-[12px] font-medium">The latest candidate who applied for a role</span>
            </aside>
            <a href="{{ route('employer.candidates') }}" class="px-3 py-1 font-medium text-blue-800 hover:underline underline-offset-4 decoration-blue-800">View All Applications</a>
        </div>
        <table class="border-collapse">
            <thead class="">
                <tr class="bg-[#f3f3fd] text-[15px] text-gray-500 font-medium uppercase">
                    <td class="py-3 px-4">Candidate</td>
                    <td class="p-3">Position</td>
                    <td class="p-3">Date Applied</td>
                    <td class="p-3">Status</td>
                    <td class="p-3 text-center">Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                @php
                $candidate = $application->seeker;
                $candidate_name = $candidate->first_name . " " . $candidate->last_name;
                $name_abbreviation = mb_substr($candidate->first_name, 0, 1) . mb_substr($candidate->last_name, 0, 1);
                $candidate_email = $candidate->user->email;
                $resume = $candidate->resume_url;
                $career = $application->career;
                $position = $career->title;
                $applied_date = \Carbon\Carbon::parse($application->created_at)->diffForHumans();
                $status = $application->status;
                @endphp
                <tr class="border-t border-gray-300 bg-white">
                    <td class="py-3 px-4 flex gap-4 items-center">
                        <x-name_abbreviation :name="$name_abbreviation" :application_status="$application->status" />
                        <div class="flex flex-col">
                            <span class="font-medium">
                                {{ $candidate_name }}
                            </span>
                            <span class="text-gray-600 text-sm flex gap-2">{{ $candidate_email }}</span>
                        </div>
                    </td>
                    <td class="p-3">{{ $position }}</td>
                    <td class="p-3 rounded-md">
                        <span class="text-gray-600">{{ $applied_date }}</span>
                    </td>
                    <td class="p-3 font-medium capitalize">
                        <x-application_status :application_status="$application->status" />
                    </td>
                    <td>
                        <div class="flex items-center justify-evenly">
                            <a href="{{ route('employer.candidates.show',['career' => $career->slug]) }}" class=" mt-3 text-green-600 text-xl"><i class="fi fi-rs-eye"></i></a>
                            <a href="{{ $resume }}" target="_blank" class=" mt-3 text-blue-600 text-xl"><i class="fi fi-rr-document"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</main>