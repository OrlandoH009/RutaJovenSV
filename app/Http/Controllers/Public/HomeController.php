<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AcademicArea;
use App\Models\Career;
use App\Models\Institution;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request, RecommendationService $recommendations)
    {
        $profile = $request->user()?->interestProfile;
        $labels = config('interests.labels');

        return view('home', [
            // Con sesión y cuestionario hecho: sus 3 intereses más altos y la carrera que más concuerda.
            'profile' => $profile,
            'topInterests' => $profile
                ? collect($profile->scores)->filter(fn ($s) => $s > 0)->sortDesc()->take(3)->mapWithKeys(fn ($s, $k) => [$labels[$k] ?? $k => $s])
                : collect(),
            'bestCareer' => $profile ? $recommendations->relatedCareers($profile, 1)->first() : null,
            'areas' => AcademicArea::withCount('careers')->orderBy('name')->get(),
            'careersCount' => Career::count(),
            'institutionsCount' => Institution::higherEducation()->whereNull('parent_id')->count(),
            'featuredCareers' => Career::with('academicArea')->inRandomOrder()->limit(4)->get(),
            'institutionNames' => Institution::higherEducation()->whereNull('parent_id')->orderBy('name')->limit(14)->pluck('name'),
        ]);
    }
}
