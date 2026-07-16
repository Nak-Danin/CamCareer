@php
$chartLabels = [
'4 weeks ago',
'3 weeks ago',
'2 weeks ago',
'1 week ago',
'this week'
];

$chartValues = [
$fourWeekAgoApplication,
$threeWeekAgoApplication,
$twoWeekAgoApplication,
$oneWeekAgoApplication,
$thisWeekApplication
]

@endphp

<x-employer-layout heading='Employer Dashboard'>
    <div class="flex justify-between items-baseline">
        <span class="text-description   ">Welcome back, RecruitPro. Here's what's happening with your listing</span>
        <button class="btn-outlined flex gap-3 items-center"><i class="fi fi-bs-download"></i>Export Report</button>
    </div>
    <div class="overflow-x-scroll lg:overflow-x-hidden w-full grid grid-cols-4 gap-6">
        <x-metric-card
            title="ACTIVE JOBS"
            :value="$activeJobsCount"
            :badge-text="'+' . $newJobsThisWeekCount . ' this week'"
            icon="fi fi-rr-briefcase" />
        <x-metric-card
            title="TOTAl APPLICATIONS"
            :value="$totalApplicationsCount"
            :badge-text="'+' . $recentApplied . ' this month'"
            icon="fi fi-rr-document" />
        <x-metric-card
            title="TOTAL CANDIDATES"
            :value="$totalCandidatesCount"
            :badge-text="'+' . $candidateAppliedToday . ' today'"
            icon="fi fi-rs-user-add" />
        <x-metric-card
            title="INTERVIEWS SCHEDULED"
            :value="$interviewCandidates"
            icon="fi fi-rr-calendar" />
    </div>
    <div class="w-full grid grid-cols-[5fr_3fr] gap-5">
        <x-application_chart :labels='$chartLabels' :values="$chartValues" />
        <div class="bg-white p-6 flex flex-col gap-5 rounded-xl shadow-sm border border-gray-100">
            <section class="flex justify-between">
                <span class="text-heading text-lg">Upcoming Interviews</span>
                <a class="text-blue-800 hover:bg-gray-200 px-2" href="{{ route('employer.interviews') }}">View All</a>

            </section>
            <ul class="flex flex-col gap-5">
                @foreach ($upcomingInterviews as $interview)
                @php
                $interviewee = $interview->application->seeker;
                $interview_date = \Carbon\Carbon::parse($interview->interview_date)->format('jS');
                $interview_month = \Carbon\Carbon::parse($interview->interview_date)->format('F');
                $interview_year = \Carbon\Carbon::parse($interview->interview_date)->format('Y');
                @endphp
                <li class="bg-gray-100 rounded-sm px-4 py-2">
                    <div class="flex gap-4">
                        <aside class="flex flex-col items-center justify-center text-gray-600">
                            <i class="fi fi-rr-calendar-clock text-2xl "></i>
                            <span class="text-[12px] font-medium">{{ $interview_date }} {{ $interview_month }}</span>
                        </aside>
                        <aside>
                            <h1 class="text-heading text-sm">{{ $interviewee->first_name }} {{ $interviewee->last_name }}</h1>
                            <span class="text-description text-[12px] font-medium">Job Title: {{ $interview->application->career->title }}</span>
                            <div class="text-description text-[12px] font-medium">Time: {{ $interview->interview_time }}</div>
                        </aside>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-employer-layout>