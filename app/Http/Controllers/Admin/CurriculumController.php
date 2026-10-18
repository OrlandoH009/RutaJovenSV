<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CurriculumItem;
use App\Models\Institution;
use App\Models\InstitutionCareer;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function edit(Institution $institution, InstitutionCareer $institutionCareer)
    {
        abort_unless($institutionCareer->institution_id === $institution->id, 404);

        $institutionCareer->load(['career', 'curriculumItems']);

        return view('admin.institutions.curriculum', [
            'institution' => $institution,
            'institutionCareer' => $institutionCareer,
        ]);
    }

    public function updateName(Request $request, Institution $institution, InstitutionCareer $institutionCareer)
    {
        abort_unless($institutionCareer->institution_id === $institution->id, 404);

        $validated = $request->validate([
            'official_career_name' => ['nullable', 'string', 'max:255'],
        ]);

        $institutionCareer->update($validated);

        return back()->with('status', 'Nombre oficial actualizado.');
    }

    public function storeItem(Request $request, Institution $institution, InstitutionCareer $institutionCareer)
    {
        abort_unless($institutionCareer->institution_id === $institution->id, 404);

        $validated = $request->validate([
            'cycle_label' => ['required', 'string', 'max:100'],
            'cycle_number' => ['nullable', 'integer', 'min:0', 'max:20'],
            'subject_name' => ['required', 'string', 'max:255'],
            'subject_code' => ['nullable', 'string', 'max:50'],
            'credits' => ['nullable', 'integer', 'min:0', 'max:99'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $institutionCareer->curriculumItems()->create($validated);

        return back()->with('status', 'Materia agregada al pensum.');
    }

    public function destroyItem(Institution $institution, InstitutionCareer $institutionCareer, CurriculumItem $item)
    {
        abort_unless($institutionCareer->institution_id === $institution->id, 404);
        abort_unless($item->institution_career_id === $institutionCareer->id, 404);

        $item->delete();

        return back()->with('status', 'Materia eliminada del pensum.');
    }
}
