<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index()
    {
        $featureCareers = Career::availableCareers()->latest()->take(4)->get();
        return view('careers.seeker.homepage', compact('featureCareers'));
    }
    public function show(Career $career)
    {
        return view('careers.show', compact('career'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('careers.create', compact("categories"));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => ['required', 'string', 'max:150'],

            'salary_range' => ['nullable', 'string', 'max:255'],

            'category_id' => ['required', 'numeric'],

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
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 2;
        while (Career::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $company = Auth::user()->company;
        //create career
        $company->careers()->create([...$validated, 'slug' => $slug]);
        return redirect()->route('employer.jobs')->with('success', 'Create new career successfully');
    }
    public function edit(Career $career)
    {
        $categories = Category::all();
        return view('careers.edit', compact('career', 'categories'));
    }
    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([

            'title' => ['required', 'string', 'max:150'],

            'salary_range' => ['nullable', 'string', 'max:255'],

            'category_id' => ['required', 'numeric'],

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
        return redirect()->route('employer.viewJob', $career)->with('success', 'Update Successfully');
    }
    public function destroy(Career $career)
    {
        $career->update([
            'status' => 'unavailable'
        ]);
        return redirect()->route('employer.viewJob', $career)->with('success', 'Close out successfully');
    }
    public function reopen(Career $career)
    {
        $career->update(['status' => 'available']);
        return redirect()->route('employer.viewJob', $career)->with('success', 'Reopen Successfully');
    }
}
