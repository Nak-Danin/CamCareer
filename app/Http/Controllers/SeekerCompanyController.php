<?php

namespace App\Http\Controllers;

use App\Models\Company;

class SeekerCompanyController extends Controller
{
    public function index()
    {
        $topCompanies = Company::topCompanies()->get();
        return view('careers.seeker.companies', compact('topCompanies'));
    }
}
