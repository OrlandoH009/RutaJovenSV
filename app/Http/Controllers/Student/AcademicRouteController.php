<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AcademicRoute;
use Illuminate\Http\Request;

class AcademicRouteController extends Controller
{
    public function show(Request $request)
    {
        $route = $request->user()->academicRoute ?? new AcademicRoute(['next_steps' => []]);

        if ($route->exists) {
            $route->load('items.career', 'items.institution');
        }

        return view('my-route.show', [
            'route' => $route,
            'savedCareers' => $request->user()->savedCareers()->with('career')->get(),
            'savedInstitutions' => $request->user()->savedInstitutions()->with('institution')->get(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'goal_text' => ['nullable', 'string', 'max:255'],
            'next_steps' => ['nullable', 'array'],
        ], [
            'goal_text.max' => 'El objetivo es muy largo. Intenta resumirlo en menos de 255 caracteres.',
        ]);

        // Cada "paso" debería ser un texto simple, pero por robustez ante
        // datos inesperados (o un registro previo mal guardado) se descarta
        // cualquier valor que no sea texto en lugar de rechazar todo el
        // formulario con un error críptico.
        $steps = collect($request->input('next_steps', []))
            ->map(fn ($step) => is_string($step) ? trim($step) : '')
            ->filter()
            ->map(fn ($step) => \Illuminate\Support\Str::limit($step, 255, ''))
            ->values()
            ->all();

        $request->user()->academicRoute()->updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'goal_text' => $validated['goal_text'] ?? null,
                'next_steps' => $steps,
            ]
        );

        return back()->with('status', 'Tu ruta académica se actualizó.');
    }

    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'career_id' => ['nullable', 'exists:careers,id'],
            'institution_id' => ['nullable', 'exists:institutions,id'],
        ]);

        if (empty($validated['career_id']) && empty($validated['institution_id'])) {
            return back()->withErrors('Selecciona una carrera o institución para agregar.');
        }

        $route = $request->user()->academicRoute ?? $request->user()->academicRoute()->create();

        $position = $route->items()->max('position') + 1;

        $route->items()->create([
            'career_id' => $validated['career_id'] ?? null,
            'institution_id' => $validated['institution_id'] ?? null,
            'position' => $position,
        ]);

        return back()->with('status', 'Opción agregada a tu ruta.');
    }

    public function removeItem(Request $request, int $item)
    {
        $request->user()->academicRoute?->items()->where('id', $item)->delete();

        return back()->with('status', 'Opción quitada de tu ruta.');
    }
}
