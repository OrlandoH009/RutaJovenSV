<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AcademicArea;
use App\Models\Career;
use App\Models\CurriculumItem;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $careers = Career::with('academicArea')
            ->when($request->filled('area'), fn ($q) => $q->where('academic_area_id', $request->integer('area')))
            ->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%'.$request->string('q').'%'))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('careers.index', [
            'careers' => $careers,
            'areas' => AcademicArea::orderBy('name')->get(),
        ]);
    }

    public function show(Career $career, RecommendationService $recommendations)
    {
        $career->load(['academicArea', 'interestWeights', 'institutions']);

        $curriculumByPivotId = CurriculumItem::whereIn('institution_career_id', $career->institutions->pluck('pivot.id'))
            ->orderByRaw('cycle_number IS NULL, cycle_number')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('institution_career_id');

        $relatedCareers = collect();
        $user = auth()->user();

        if ($user && $user->interestProfile) {
            $relatedCareers = $recommendations->relatedCareers($user->interestProfile, limit: 4, excludeCareerId: $career->id);
        }

        $isSaved = $user
            ? $user->savedCareers()->where('career_id', $career->id)->exists()
            : false;

        return view('careers.show', [
            'career' => $career,
            'relatedCareers' => $relatedCareers,
            'isSaved' => $isSaved,
            'curriculumByPivotId' => $curriculumByPivotId,
        ]);
    }
}
