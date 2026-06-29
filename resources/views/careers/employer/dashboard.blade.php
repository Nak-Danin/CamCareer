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
</x-employer-layout>