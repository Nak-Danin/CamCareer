<x-employer-layout heading="">
    <div class="flex flex-col gap-5 w-full mb-5">
        <section class="flex justify-between items-center">
            <x-job_heading :career="$career" />
            <div class="flex gap-3">
                <x-button_link
                    link="{{ route('employer.viewJob',['career' => $career]) }}"
                    id="btn-editjob"
                    styling="btn-warning"
                    title="Update"
                    icon="fi fi-rr-pencil" />
                @if ($career->status !== 'unavailable')
                <x-button_link
                    link="{{ route('employer.viewJob',['career' => $career]) }}"
                    id="btn-close-listing"
                    styling="btn-danger"
                    title="Close out"
                    icon="fi fi-rr-ban" />
                @endif
                <x-button_link
                    link="{{ route('employer.candidates.show',['career' => $career->slug]) }}"
                    id="btn-view-candidate"
                    styling="btn-primary"
                    title="View Candidates"
                    icon="fi fi-rr-users" />
            </div>
        </section>
        <section class="grid grid-cols-3 gap-10">
            <x-metric-card
            title="TOTAl APPLICATIONS"
            :value="$applicationsCount"
            icon="fi fi-rr-document" />
        <x-metric-card
            title="New Applications"
            :value="$recentApplicationsCount"
            icon="fi fi-rr-document" />
        <x-metric-card
            title="Interviews Schedule"
            :value="$interviewsCount"
            icon="fi fi-rr-document" />

        </section>
        <section class="w-full bg-white border border-gray-100 shadow-sm pb-5 rounded-t-md">
            <h1 class="w-full p-5 bg-[#f3f3fd] text-xl font-medium border-b-2 border-gray-200">Job Description</h1>
            <div class="flex flex-col gap-5 p-5">
                <section class="flex flex-col gap-2">
                    <h1 class="text-blue-700 text-lg uppercase">The Role</h1>
                    <span>{{ $career->description }}</span>
                </section>
                <section class="flex flex-col gap-2">
                    <h1 class="text-blue-700 text-lg uppercase">Key Qualifications</h1>
                    <ul class="flex flex-col gap-3">
                        @foreach ($career->requirements as $requirement)
                            <li class="flex gap-2 items-baseline"><i class="fi fi-ss-circle text-gray-500 text-[6px]"></i>{{ $requirement }}</li>
                        @endforeach
                    </ul>
                </section>
                <section class="flex flex-col gap-2">
                    <h1 class="text-blue-700 text-lg uppercase">Job Responsibilities</h1>
                    <ul class="flex flex-col gap-3">
                        @foreach ($career->responsibilities as $responsibility)
                            <li class="flex gap-2 items-baseline"><i class="fi fi-ss-circle text-gray-500 text-[6px]"></i>{{ $responsibility }}</li>
                        @endforeach
                    </ul>
                </section>
            </div>
            <div class="grid grid-cols-3 gap-5 p-5">
                <x-job_description_card
                    title="Compensation"
                    :value="'$ ' . $career->salary_range . ' (USD)'"
                />
                <x-job_description_card
                    title="Employment Type"
                    :value="$career->career_type"
                />
                <x-job_description_card
                    title="Location"
                    :value="$career->location"
                />
            </div>
        </section>
    </div>
</x-employer-layout>