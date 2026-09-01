<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Application $application, Career $career)
    {
        $seeker = Auth::user()->seeker;
        $newApplication = [
            'career_id' => $career->career_id,
            'seeker_id' => $seeker->seeker_id,
            'status' => "applied"
        ];
        $application::create($newApplication);
        return redirect()->route("seeker.home")->with('success', 'Applied to Job successfully');
    }
}
