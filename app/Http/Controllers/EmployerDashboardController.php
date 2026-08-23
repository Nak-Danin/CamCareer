<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelPdf\Facades\Pdf;

class EmployerDashboardController extends Controller
{
    public function exportPdf(Request $request)
    {
        $company = Auth::user()->company;
        $company_name = $company->company_name;
        $monthParam = $request->query('month', now()->format('Y-m'));
        $selectedDate = Carbon::createFromFormat('Y-m', $monthParam)->startOfMonth();
        $startDate = $selectedDate->copy()->startOfMonth();
        $endDate = $selectedDate->copy()->endOfMonth();
        $reportPeriod = $startDate->format('F j, Y') . ' - ' . $endDate->format('F j, Y');
        $totalApplications = $company->applications()->get();
        $totalApplicationsCount = $totalApplications->count();
        $totalCareers = $company->careers()->get();
        $totalCareersPosted = $totalCareers->count();
        $weekStart = $startDate->copy()->startOfWeek();
        $weeks = [];
        while ($weekStart->lte($endDate)) {

            $weekEnd = $weekStart->copy()->endOfWeek();

            // Prevent the week from going outside the selected month
            $actualStart = $weekStart->lt($startDate)
                ? $startDate->copy()
                : $weekStart->copy();

            $actualEnd = $weekEnd->gt($endDate)
                ? $endDate->copy()
                : $weekEnd->copy();

            $count = $company->applications()
                ->whereBetween('applications.created_at', [
                    $actualStart,
                    $actualEnd
                ])
                ->count();
            $nameOfWeek = 'Week ' . (count($weeks) + 1);
            $weeks[$nameOfWeek] = $count;
            $weekStart->addWeek();
        }
        $careerSummary = [];
        $selectedCandidateInfo = [];
        foreach ($totalCareers as $career) {
            $careerApplicationCount = $career->applications->count();
            $selectedCandidateApplication = $career->applications->where('status', 'offered')->first();
            $selectedCandidateApplicationCount = $career->applications->where('status', 'offered')->count();
            if ($selectedCandidateApplication) {
                $selectedCandidateInfo[] = [
                    'position' => $career->title,
                    'name' => $selectedCandidateApplication->seeker->first_name . ' ' . $selectedCandidateApplication->seeker->last_name,
                    'email' => $selectedCandidateApplication->seeker->user->email,
                    'phone' => $selectedCandidateApplication->seeker->phone
                ];
            }
            $careerSummary[] = [
                'position' => $career->title,
                'applied' => $careerApplicationCount,
                'selected' => $selectedCandidateApplicationCount
            ];
        }

        $data = [
            'company_name' => $company_name,
            'report_period' => $reportPeriod,
            'generated_at' => now()->format('F d, Y'),
            'total_applications' => $totalApplicationsCount,
            'total_careers_posted' => $totalCareersPosted,
            'weekly_applications' => [
                'Week1' => $weeks['Week 1'],
                'Week2' => $weeks['Week 2'],
                'Week3' => $weeks['Week 3'],
                'Week4' => $weeks['Week 4'],
            ],
            'career_summary' => $careerSummary,
            'selected_candidates' => $selectedCandidateInfo
        ];
        $fileName = 'Monthly_Recruitment_Report_' . $selectedDate->format('F_Y');
        return Pdf::view('careers.employer.monthly_report', $data)
            ->format('a4')
            ->name($fileName . '.pdf');
    }
}
