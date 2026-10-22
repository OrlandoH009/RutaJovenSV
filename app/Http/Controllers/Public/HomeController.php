<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AcademicArea;
use App\Models\Career;
use App\Models\Institution;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'areas' => AcademicArea::withCount('careers')->orderBy('name')->get(),
            'careersCount' => Career::count(),
            'institutionsCount' => Institution::count(),
            'featuredCareers' => Career::with('academicArea')->inRandomOrder()->limit(4)->get(),
            'institutionNames' => Institution::orderBy('name')->limit(14)->pluck('name'),
        ]);
    }
}
