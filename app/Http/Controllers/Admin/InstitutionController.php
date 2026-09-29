<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstitutionController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.institutions.index', [
            'institutions' => Institution::withCount('careers')
                ->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%'.$request->string('q').'%'))
                ->orderBy('name')
                ->paginate(15)
                ->withQueryString(),
        ]);
    }

    public function create()
    {
        return view('admin.institutions.form', ['institution' => new Institution]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        Institution::create($validated);

        return redirect()->route('admin.institutions.index')->with('status', 'Institución creada.');
    }

    public function edit(Institution $institution)
    {
        $institution->load('careers');

        return view('admin.institutions.form', [
            'institution' => $institution,
            'availableCareers' => Career::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Institution $institution)
    {
        $validated = $this->validated($request, $institution->id);
        $institution->update($validated);

        return redirect()->route('admin.institutions.edit', $institution)->with('status', 'Institución actualizada.');
    }

    public function destroy(Institution $institution)
    {
        $institution->delete();

        return redirect()->route('admin.institutions.index')->with('status', 'Institución eliminada.');
    }

    public function addCareer(Request $request, Institution $institution)
    {
        $validated = $request->validate([
            'career_id' => ['required', 'exists:careers,id'],
            'modality' => ['required', 'in:presencial,virtual,mixta'],
            'requirements' => ['nullable', 'string'],
            'cost_info' => ['nullable', 'string'],
        ]);

        $institution->careers()->syncWithoutDetaching([
            $validated['career_id'] => [
                'modality' => $validated['modality'],
                'requirements' => $validated['requirements'] ?? null,
                'cost_info' => $validated['cost_info'] ?? null,
            ],
        ]);

        return back()->with('status', 'Carrera vinculada a la institución.');
    }

    public function removeCareer(Institution $institution, Career $career)
    {
        $institution->careers()->detach($career->id);

        return back()->with('status', 'Carrera desvinculada de la institución.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:100'],
            'municipality' => ['nullable', 'string', 'max:100'],
            'institution_type' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'url', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['contact_info'] = array_filter(['website' => $validated['website'] ?? null]);

        return $validated;
    }
}
