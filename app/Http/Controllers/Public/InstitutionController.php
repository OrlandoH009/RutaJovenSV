<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function index(Request $request)
    {
        $institutions = Institution::withCount('careers')
            ->when($request->filled('department'), fn ($q) => $q->where('department', $request->string('department')))
            ->when($request->filled('modality'), fn ($q) => $q->whereHas('careers', fn ($q2) => $q2->where('modality', $request->string('modality'))))
            ->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%'.$request->string('q').'%'))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('institutions.index', [
            'institutions' => $institutions,
            'departments' => Institution::select('department')->distinct()->whereNotNull('department')->orderBy('department')->pluck('department'),
        ]);
    }

    public function show(Institution $institution)
    {
        $institution->load(['careers.academicArea']);

        $user = auth()->user();
        $isSaved = $user
            ? $user->savedInstitutions()->where('institution_id', $institution->id)->exists()
            : false;

        return view('institutions.show', [
            'institution' => $institution,
            'isSaved' => $isSaved,
        ]);
    }
}
