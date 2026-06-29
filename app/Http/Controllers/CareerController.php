<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::availableCareers()->latest()->get();
        return view('careers.index', compact('careers'));
    }
    public function show(Career $career)
    {
        return view('careers.show', compact('career'));
    }
    public function create()
    {
        return view('careers.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => ['required', 'string', 'max:150'],

            'salary_range' => ['nullable', 'string', 'max:255'],

            'description' => ['required', 'string'],

            'responsibilities' => ['required', 'array', 'min:1'],
            'responsibilities.*' => ['required', 'string'],

            'requirements' => ['required', 'array', 'min:1'],
            'requirements.*' => ['required', 'string'],

            'benefits' => ['required', 'array', 'min:1'],
            'benefits.*' => ['required', 'string'],

            'location' => ['required', 'string', 'max:255'],

            'career_type' => [
                'required',
                'in:full-time,part-time,internship,contract'
            ],
        ]);
        $company = Auth::user()->company;
        //create career
        $company->careers()->create($validated);
        return redirect()->route('careers')->with('success', 'Create new career successfully');
    }
    public function edit(Career $career)
    {
        return view('careers.edit', compact('career'));
    }
    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([

            'title' => ['required', 'string', 'max:150'],

            'salary_range' => ['nullable', 'string', 'max:255'],

            'description' => ['required', 'string'],

            'responsibilities' => ['required', 'array', 'min:1'],
            'responsibilities.*' => ['required', 'string'],

            'requirements' => ['required', 'array', 'min:1'],
            'requirements.*' => ['required', 'string'],

            'benefits' => ['required', 'array', 'min:1'],
            'benefits.*' => ['required', 'string'],

            'location' => ['required', 'string', 'max:255'],

            'career_type' => [
                'required',
                'in:full-time,part-time,internship,contract'
            ],

            'status' => [
                'sometimes',
                'in:available,unavailable'
            ],
        ]);
        //update
        $career->update($validated);
        return redirect()->route('careers.show', $career)->with('success', 'Update Successfully');
    }
    public function destroy(Career $career)
    {
        $career->update([
            'status' => 'unavailable'
        ]);
        return redirect()->route('careers');
    }
}
