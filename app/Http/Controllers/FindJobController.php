<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FindJobController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("careers.seeker.explore_jobs_by_category", compact("categories"));
    }
}
