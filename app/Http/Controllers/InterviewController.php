<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Career;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    public function index()
    {
        $company = Auth::user()->company;
        $careers = Career::where('company_id', $company->company_id)
            ->with([
                'applications' => function ($query) {
                    $query->where('status', 'interview')
                        ->whereHas('interview', function ($q) {
                            $q->whereNotIn('status', ['completed', 'cancelled']);
                        })
                        ->with(['seeker', 'interview']);
                }
            ])->get();
        return view('careers.employer.interviews', compact('careers'));
    }

    public function completeInterview(Interview $interview)
    {
        $interview->update(['status' => 'completed']);
        $application = $interview->application;
        return redirect()->route('employer.candidates.show', ['career' => $application->career->slug]);
    }

    public function cancelInterview(Interview $interview)
    {
        $interview->update(['status' => 'cancelled']);
        return redirect()->route('employer.interviews');
    }

    public function create(Application $application)
    {
        return view("careers.employer.create_interview", compact('application'));
    }

    public function store(Request $request, Application $application)
    {
        $validates = $request->validate([
            'interview_date' => ['date', 'required', 'after_or_equal:today'],
            'interview_time' => ['required', 'date_format:H:i'],
            'location' => ['nullable', 'string', 'max:255'],
            'meeting_link' => ['nullable', 'url'],
            'status' => ['in:scheduled,rescheduled,completed,cancelled']
        ]);

        $validates['application_id'] = $application->id;
        $validates['meeting_link'] = $request->input('meeting_link', null);
        $validates['status'] = 'scheduled';
        Interview::create($validates);
        $application->update(['status' => 'interview']);
        return redirect()->route('employer.interviews')->with('success', 'schedule created successfully');
    }
}
