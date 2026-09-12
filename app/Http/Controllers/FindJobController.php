<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareerFilterRequest;
use App\Models\Career;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FindJobController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("careers.seeker.explore_jobs_by_category", compact("categories"));
    }
    public function filterJobs(CareerFilterRequest $request)
    {
        $filters = $request->validated();
        $seeker = Auth::user()->seeker;

        $careers = Career::query()
            ->availableCareers()
            ->with(['company', 'category'])
            ->keyword($filters['keyword'] ?? null)
            ->categoryId($filters['category'] ?? null)
            ->employmentType($filters['employment_type'] ?? null)
            ->location($filters['location'] ?? null)
            ->sortBy($filters['sort'] ?? 'recent')
            ->paginate(5)
            ->appends($request->query());
        $categories = Category::all();
        return view('careers.seeker.filter_jobs', compact('careers', 'categories', 'filters', 'seeker'));
    }
}
