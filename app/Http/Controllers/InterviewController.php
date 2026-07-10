<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    public function index()
    {
        $company = Auth::user()->company;
        $careers = Career::where('company_id', $company->company_id)
            ->with([
                'applications' => function ($query) {
                    $query->where('status', 'interview')->with(['seeker', 'interview']);
                }
            ])->get();
        return view('careers.employer.interviews', compact('careers'));
    }
}
