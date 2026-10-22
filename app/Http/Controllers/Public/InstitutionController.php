<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function index(Request $request)
    {
        // Solo universidades principales; sus campus se eligen dentro de la ficha.
        $institutions = Institution::higherEducation()->whereNull('parent_id')
            ->with(['careers:careers.id', 'campuses.careers:careers.id'])
            ->when($request->filled('department'), fn ($q) => $q->where(fn ($q2) => $q2
                ->where('department', $request->string('department'))
                ->orWhereHas('campuses', fn ($q3) => $q3->where('department', $request->string('department')))))
            ->when($request->filled('modality'), fn ($q) => $q->where(fn ($q2) => $q2
                ->whereHas('careers', fn ($q3) => $q3->where('modality', $request->string('modality')))
                ->orWhereHas('campuses.careers', fn ($q3) => $q3->where('modality', $request->string('modality')))))
            ->when($request->filled('q'), fn ($q) => $q->where(fn ($q2) => $q2
                ->where('name', 'like', '%'.$request->string('q').'%')
                ->orWhereHas('campuses', fn ($q3) => $q3->where('name', 'like', '%'.$request->string('q').'%'))))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('institutions.index', [
            'institutions' => $institutions,
            'departments' => Institution::higherEducation()->select('department')->distinct()->whereNotNull('department')->orderBy('department')->pluck('department'),
        ]);
    }

    public function show(Request $request, Institution $institution)
    {
        abort_if($institution->institution_type && str_starts_with($institution->institution_type, 'Instituto'), 404);

        // Un campus se muestra dentro de su universidad, con ese campus preseleccionado.
        if ($institution->parent_id) {
            return redirect()->route('institutions.show', array_filter(['institution' => $institution->parent, 'campus' => $institution->id, 'career' => $request->query('career')]));
        }

        $institution->load(['careers.academicArea', 'campuses.careers.academicArea']);

        $user = auth()->user();
        $isSaved = $user
            ? $user->savedInstitutions()->where('institution_id', $institution->id)->exists()
            : false;

        // Sede principal primero, luego los campus.
        $campuses = collect([$institution])->merge($institution->campuses);

        // Si llega desde una carrera, solo se muestra esa carrera y los campus que la ofrecen.
        $focusCareer = $campuses->flatMap->careers->firstWhere('slug', $request->query('career'));

        if ($focusCareer) {
            $campuses = $campuses->filter(fn ($c) => $c->careers->contains('id', $focusCareer->id))->values();
            $campuses->each(fn ($c) => $c->setRelation('careers', $c->careers->where('id', $focusCareer->id)->values()));
        }

        return view('institutions.show', [
            'institution' => $institution,
            'campuses' => $campuses,
            'focusCareer' => $focusCareer,
            'selectedCampusId' => $campuses->contains('id', $request->integer('campus')) ? $request->integer('campus') : $campuses->first()->id,
            'isSaved' => $isSaved,
        ]);
    }
}
