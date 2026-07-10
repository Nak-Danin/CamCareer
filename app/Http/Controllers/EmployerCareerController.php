<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Career;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmployerCareerController extends Controller
{
    public function index()
    {
        $company = Auth::user()->company;
        $company_id = $company->company_id;
        // 1. Get the total active jobs count
        $activeJobsCount = Career::where('company_id', $company_id)->availableCareers()->count();

        // 2. Get the count of jobs created this week
        $newJobsThisWeekCount = Career::where('company_id', $company_id)
            ->whereDate('careers.created_at', '>=', Carbon::now()->startOfWeek())
            ->count();

        // 3. Get Total Applications
        $totalApplications = $company->applications();
        $totalApplicationsCount = $totalApplications->count();
        $recentApplied = $totalApplications->whereBetween('applications.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();

        // 4. Get Total Candidates
        $totalCandidates = $totalApplications->distinct('applications.seeker_id');
        $totalCandidatesCount = $totalCandidates->count();
        $candidateAppliedToday = $totalCandidates->WhereBetween('applications.created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();

        // 5. Get Interview Candidates
        $interviewCandidates = $company->applications()->where('applications.status', 'interview')->count();

        //6. get statistic of application
        $thisWeekApplication = $company->applications()->whereDate('applications.created_at', '>=', Carbon::now()->startOfWeek())->count();
        $oneWeekAgoApplication = $company->applications()->whereBetween('applications.created_at', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])->count();
        $twoWeekAgoApplication = $company->applications()->whereBetween('applications.created_at', [Carbon::now()->startOfWeek()->subWeeks(2), Carbon::now()->endOfWeek()->subWeeks(2)])->count();
        $threeWeekAgoApplication = $company->applications()->whereBetween('applications.created_at', [Carbon::now()->startOfWeek()->subWeeks(3), Carbon::now()->endOfWeek()->subWeeks(3)])->count();
        $fourWeekAgoApplication = $company->applications()->whereBetween('applications.created_at', [Carbon::now()->startOfWeek()->subWeeks(4), Carbon::now()->endOfWeek()->subWeeks(4)])->count();


        return view(
            'careers.employer.dashboard',
            compact(
                'activeJobsCount',
                'newJobsThisWeekCount',
                'totalApplicationsCount',
                'recentApplied',
                'totalCandidatesCount',
                'candidateAppliedToday',
                'interviewCandidates',
                'thisWeekApplication',
                'oneWeekAgoApplication',
                'twoWeekAgoApplication',
                'threeWeekAgoApplication',
                'fourWeekAgoApplication',
            )
        );
    }
    public function jobs()
    {
        $careers = Career::companyCareers()->latest()->paginate(5);
        return view('careers.employer.jobs', compact('careers'));
    }
    public function viewJob(Career $career)
    {
        $applicationsCount = $career->applications->count();
        $recentApplicationsCount = $career->applications->whereBetween('applications.create_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();
        $interviewsCount = $career->applications->where('status', 'interview')->count();
        return view(
            'careers.employer.job_detail',
            compact('career', 'applicationsCount', 'recentApplicationsCount', 'interviewsCount')
        );
    }
    public function candidates()
    {
        $careers = Career::companyCareers()->latest()->get();
        return view('careers.employer.candidates-preview', compact('careers'));
    }
    public function jobApplications(Career $career)
    {
        // 1. Load the relationships onto the career model to prevent N+1 queries
        $career->load('applications.seeker');
        $applications = $career->applications;
        return view('careers.employer.candidates', compact('career', 'applications'));
    }
    public function updateApplicationStatus(Application $application, string $status)
    {
        $career = $application->career;
        if ($career->status === "unavailable") {
            return redirect()->back()->with('error', 'This career is unavailable and cannot be modified any applciation');
        }

        if ($status === "offered") {
            $career->update(['status' => 'unavailable']);
        }
        $application->update(['status' => $status]);
        return redirect()->back()->with('success', 'update status successfully');
    }
    public function revokeOffer(Application $application)
    {
        $application->update(['status' => 'interview']);
        $application->career->update(['status' => 'available']);
        return redirect()->back()->with('success', 'Revoke Offer for succeeded candidate');
    }
}
