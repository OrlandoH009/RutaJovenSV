<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(Request $request)
    {
        $ids = collect(explode(',', (string) $request->query('careers')))
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->unique()
            ->take(3);

        $careers = $ids->isNotEmpty()
            ? Career::with(['academicArea', 'interestWeights', 'institutions'])->whereIn('id', $ids)->get()->sortBy(fn ($c) => $ids->search($c->id))->values()
            : collect();

        $availableCareers = Career::with('academicArea:id,name')
            ->orderBy('name')
            ->get(['id', 'name', 'academic_area_id'])
            ->groupBy(fn ($career) => $career->academicArea?->name ?? 'Otras')
            ->sortKeys();

        return view('compare.index', [
            'careers' => $careers,
            'availableCareers' => $availableCareers,
            'selectedIds' => $ids,
        ]);
    }
}
