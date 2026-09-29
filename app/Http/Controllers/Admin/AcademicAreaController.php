<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicArea;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AcademicAreaController extends Controller
{
    public function index()
    {
        return view('admin.areas.index', [
            'areas' => AcademicArea::withCount('careers')->orderBy('name')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.areas.form', ['area' => new AcademicArea]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        AcademicArea::create($validated);

        return redirect()->route('admin.areas.index')->with('status', 'Área académica creada.');
    }

    public function edit(AcademicArea $area)
    {
        return view('admin.areas.form', ['area' => $area]);
    }

    public function update(Request $request, AcademicArea $area)
    {
        $validated = $this->validated($request, $area->id);
        $area->update($validated);

        return redirect()->route('admin.areas.index')->with('status', 'Área académica actualizada.');
    }

    public function destroy(AcademicArea $area)
    {
        $area->delete();

        return redirect()->route('admin.areas.index')->with('status', 'Área académica eliminada.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        return $validated;
    }
}
