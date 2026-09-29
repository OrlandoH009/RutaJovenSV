<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicArea;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.careers.index', [
            'careers' => Career::with('academicArea')
                ->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%'.$request->string('q').'%'))
                ->orderBy('name')
                ->paginate(15)
                ->withQueryString(),
        ]);
    }

    public function create()
    {
        return view('admin.careers.form', [
            'career' => new Career,
            'areas' => AcademicArea::orderBy('name')->get(),
            'interestKeys' => config('interests.labels'),
            'currentWeights' => [],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $career = Career::create($validated);

        $this->syncWeights($career, $request);

        return redirect()->route('admin.careers.index')->with('status', 'Carrera creada.');
    }

    public function edit(Career $career)
    {
        $career->load('interestWeights');

        return view('admin.careers.form', [
            'career' => $career,
            'areas' => AcademicArea::orderBy('name')->get(),
            'interestKeys' => config('interests.labels'),
            'currentWeights' => $career->interestWeights->pluck('weight', 'interest_key'),
        ]);
    }

    public function update(Request $request, Career $career)
    {
        $validated = $this->validated($request, $career->id);
        $career->update($validated);

        $this->syncWeights($career, $request);

        return redirect()->route('admin.careers.index')->with('status', 'Carrera actualizada.');
    }

    public function destroy(Career $career)
    {
        $career->delete();

        return redirect()->route('admin.careers.index')->with('status', 'Carrera eliminada.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'academic_area_id' => ['required', 'exists:academic_areas,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'duration_text' => ['nullable', 'string', 'max:255'],
            'duration_months' => ['nullable', 'integer', 'min:1'],
            'skills' => ['nullable', 'string'],
            'typical_activities' => ['nullable', 'string'],
            'professional_fields' => ['nullable', 'string'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        return $validated;
    }

    private function syncWeights(Career $career, Request $request): void
    {
        $weights = $request->input('weights', []);

        foreach (array_keys(config('interests.labels')) as $key) {
            $value = (int) ($weights[$key] ?? 0);

            if ($value > 0) {
                $career->interestWeights()->updateOrCreate(['interest_key' => $key], ['weight' => $value]);
            } else {
                $career->interestWeights()->where('interest_key', $key)->delete();
            }
        }
    }
}
