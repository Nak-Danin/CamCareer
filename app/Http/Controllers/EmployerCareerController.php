<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Career;
use App\Models\Interview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerCareerController extends Controller
{
    public function index(Request $request)
    {
        $company = Auth::user()->company;
        $company_id = $company->company_id;

        /*
        |--------------------------------------------------------------------------
        | Month Filter
        |--------------------------------------------------------------------------
        */

        $companyStartMonth = Carbon::parse($company->created_at)
            ->startOfMonth();

        $currentMonth = Carbon::now()
            ->startOfMonth();

        $selectedMonth = $request->get(
            'month',
            $currentMonth->format('Y-m')
        );

        // Convert selected month into Carbon
        $selectedDate = Carbon::createFromFormat(
            'Y-m',
            $selectedMonth
        );

        // Prevent selecting a month before company creation
        // or a future month
        if (
            $selectedDate->lt($companyStartMonth) ||
            $selectedDate->gt($currentMonth)
        ) {
            $selectedDate = $currentMonth->copy();

            $selectedMonth = $currentMonth->format('Y-m');
        }

        $startOfMonth = $selectedDate->copy()->startOfMonth();
        $endOfMonth = $selectedDate->copy()->endOfMonth();


        /*
        |--------------------------------------------------------------------------
        | Available Months
        |--------------------------------------------------------------------------
        */

        $availableMonths = collect();

        $month = $currentMonth->copy();

        while ($month->gte($companyStartMonth)) {

            $availableMonths->push([
                'value' => $month->format('Y-m'),
                'label' => $month->format('F Y'),
            ]);

            $month->subMonth();
        }


        /*
        |--------------------------------------------------------------------------
        | 1. Active Jobs
        | Current value - NOT affected by month filter
        |--------------------------------------------------------------------------
        */

        $activeJobsCount = Career::where('company_id', $company_id)
            ->availableCareers()
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 2. New Jobs This Week
        | Current value - NOT affected by month filter
        |--------------------------------------------------------------------------
        */

        $newJobsThisWeekCount = Career::where('company_id', $company_id)
            ->whereDate(
                'careers.created_at',
                '>=',
                Carbon::now()->startOfWeek()
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 3. Applications
        |--------------------------------------------------------------------------
        */
        // Total applications for SELECTED MONTH
        $totalApplicationsCount = $company->applications()
            ->whereBetween('applications.created_at', [
                $startOfMonth,
                $endOfMonth
            ])
            ->count();


        // Applications for CURRENT MONTH
        // This is NOT affected by the month filter
        $recentApplied = $company->applications()
            ->whereBetween('applications.created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 4. Candidates
        |--------------------------------------------------------------------------
        */

        // Unique candidates for SELECTED MONTH
        $totalCandidatesCount = $company->applications()
            ->whereBetween('applications.created_at', [
                $startOfMonth,
                $endOfMonth
            ])
            ->distinct('applications.seeker_id')
            ->count('applications.seeker_id');


        // Unique candidates who applied TODAY
        // This is NOT affected by the month filter
        $candidateAppliedToday = $company->applications()
            ->whereBetween('applications.created_at', [
                Carbon::now()->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->distinct('applications.seeker_id')
            ->count('applications.seeker_id');


        /*
        |--------------------------------------------------------------------------
        | 5. Interview Candidates
        |--------------------------------------------------------------------------
        */

        // Interviews for SELECTED MONTH
        $interviewCandidates = $company->applications()
            ->where('applications.status', 'interview')
            ->whereBetween('applications.created_at', [
                $startOfMonth,
                $endOfMonth
            ])
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 6. Application Statistics / Chart
        |
        | Chart displays application count for each week
        | inside the SELECTED MONTH.
        |--------------------------------------------------------------------------
        */

        $chartLabels = [];
        $chartValues = [];

        $weekStart = $startOfMonth->copy()->startOfWeek();

        while ($weekStart->lte($endOfMonth)) {

            $weekEnd = $weekStart->copy()->endOfWeek();

            // Prevent the week from going outside the selected month
            $actualStart = $weekStart->lt($startOfMonth)
                ? $startOfMonth->copy()
                : $weekStart->copy();

            $actualEnd = $weekEnd->gt($endOfMonth)
                ? $endOfMonth->copy()
                : $weekEnd->copy();

            $count = $company->applications()
                ->whereBetween('applications.created_at', [
                    $actualStart,
                    $actualEnd
                ])
                ->count();

            $chartLabels[] = 'Week ' . (count($chartLabels) + 1);
            $chartValues[] = $count;

            $weekStart->addWeek();
        }


        /*
        |--------------------------------------------------------------------------
        | 7. Applications Table
        |
        | Keep your existing behavior:
        | latest 5 applications that aren't rejected/offered.
        |--------------------------------------------------------------------------
        */

        $tableApplications = $company->applications()
            ->whereNotIn('applications.status', [
                'rejected',
                'offered'
            ])
            ->latest()
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | 8. Upcoming Interviews
        |
        | Only show interviews belonging to the current company.
        |--------------------------------------------------------------------------
        */

        $upcomingInterviews = Interview::with([
            'application' => function ($query) {
                $query->with([
                    'seeker',
                    'career'
                ]);
            }
        ])
            ->whereHas('application.career', function ($query) use ($company_id) {
                $query->where('company_id', $company_id);
            })
            ->whereDate(
                'interview_date',
                '>=',
                Carbon::today()
            )
            ->orderBy('interview_date')
            ->limit(3)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'careers.employer.dashboard',
            compact(
                'company',
                'activeJobsCount',
                'newJobsThisWeekCount',

                // Selected month
                'totalApplicationsCount',
                'totalCandidatesCount',
                'interviewCandidates',
                'chartLabels',
                'chartValues',

                // Current month / today
                'recentApplied',
                'candidateAppliedToday',

                // Other dashboard data
                'upcomingInterviews',
                'tableApplications',

                // Month filter
                'availableMonths',
                'selectedMonth',
                'startOfMonth',
                'endOfMonth'
            )
        );
    }
    public function jobs()
    {
        $careers = Career::companyCareers()->get();
        $paginateAll = Career::companyCareers()->latest()->paginate(5);
        return view('careers.employer.jobs', compact('careers', 'paginateAll'));
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
    public function rejectApplication(Application $application)
    {
        $application->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'reject applicaiton successfully');
    }
    public function revokeOffer(Application $application)
    {
        $application->update(['status' => 'interview']);
        $application->career->update(['status' => 'available']);
        return redirect()->back()->with('success', 'Revoke Offer for succeeded candidate');
    }
}
