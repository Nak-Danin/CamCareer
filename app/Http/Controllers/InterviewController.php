<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Career;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    public function index(Request $request)
    {
        $company = Auth::user()->company;
        $type = $request->query('type', 'upcoming'); // Defaults to 'upcoming'

        // Define status filter logic based on request
        $interviewStatusCallback = function ($q) use ($type) {
            if ($type === 'past') {
                $q->whereIn('status', ['completed', 'cancelled']);
            } else {
                $q->whereNotIn('status', ['completed', 'cancelled']);
            }
        };

        $careers = Career::where('company_id', $company->company_id)
            ->whereHas('applications', function ($query) use ($interviewStatusCallback) {
                $query->where('status', 'interview')
                    ->whereHas('interview', $interviewStatusCallback);
            })
            ->with([
                'applications' => function ($query) use ($interviewStatusCallback) {
                    $query->where('status', 'interview')
                        ->whereHas('interview', $interviewStatusCallback)
                        ->with(['seeker', 'interview']);
                }
            ])
            ->get();

        // Total count of matching interview applications across all careers
        $interviews_count = $careers->sum(fn($career) => $career->applications->count());

        return view('careers.employer.interviews', compact('careers', 'interviews_count'));
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

    public function update(Request $request, Interview $interview)
    {
        $validates = $request->validate([
            'interview_date' => ['date', 'required', 'after_or_equal:today'],
            'interview_time' => ['required', 'date_format:H:i'],
            'location' => ['nullable', 'string', 'max:255'],
            'meeting_link' => ['nullable', 'url'],
            'status' => ['in:scheduled,rescheduled,completed,cancelled']
        ]);
        $validates['application_id'] = $interview->application->id;
        $validates['meeting_link'] = $request->input('meeting_link', null);
        $validates['status'] = 'rescheduled';
        $interview->update($validates);
        return redirect()->route('employer.interviews')->with('success', 'interview rescheduled successfully');
    }

    public function edit(Interview $interview)
    {
        return view('careers.employer.edit_interview', compact('interview'));
    }
}
