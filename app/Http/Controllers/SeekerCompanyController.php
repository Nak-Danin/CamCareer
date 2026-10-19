<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyFilterRequest;
use App\Models\Company;

class SeekerCompanyController extends Controller
{
    // public function index()
    // {
    //     $topCompanies = Company::topCompanies()->get();
    //     $featuredCompanies = Company::paginate(4);
    //     return view('careers.seeker.companies', compact('topCompanies', 'featuredCompanies'));
    // }

    public function filterCompanies(CompanyFilterRequest $request)
    {
        $topCompanies = Company::topCompanies()->get();
        $filters = $request->validated();
        $featuredCompanies = Company::query()
            ->companyName($filters['company'] ?? null)
            ->location($filters['location'] ?? null)
            ->industry($filters['industry'] ?? null)
            ->paginate(4)
            ->appends($request->query());
        return view('careers.seeker.companies', compact('topCompanies', 'featuredCompanies', 'filters'));
    }

    public function show(Company $company)
    {
        $totalJobsPost = $company->careers()->count();
        $availableJobs = $company->careers()->availableCareers()->get();
        $availableJobsCount = $company->careers()->availableCareers()->count();
        return view('careers.seeker.company_profile', compact('company', 'totalJobsPost', 'availableJobs', 'availableJobsCount'));
    }
}
