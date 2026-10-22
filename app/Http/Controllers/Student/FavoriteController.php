<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Institution;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('favorites.index', [
            'careers' => $user->savedCareers()->with('career.academicArea')->latest()->get()->pluck('career')->filter(),
            'institutions' => $user->savedInstitutions()->with('institution')->latest()->get()->pluck('institution')->filter(),
        ]);
    }

    public function toggleCareer(Request $request, Career $career)
    {
        $user = $request->user();
        $existing = $user->savedCareers()->where('career_id', $career->id)->first();

        if ($existing) {
            $existing->delete();
        } else {
            $user->savedCareers()->create(['career_id' => $career->id]);
        }

        if ($request->expectsJson()) {
            return response()->json(['saved' => ! $existing]);
        }

        return back()->with('status', $existing ? 'Carrera quitada de tus guardadas.' : 'Carrera guardada.');
    }

    public function toggleInstitution(Request $request, Institution $institution)
    {
        $user = $request->user();
        $existing = $user->savedInstitutions()->where('institution_id', $institution->id)->first();

        if ($existing) {
            $existing->delete();
        } else {
            $user->savedInstitutions()->create(['institution_id' => $institution->id]);
        }

        if ($request->expectsJson()) {
            return response()->json(['saved' => ! $existing]);
        }

        return back()->with('status', $existing ? 'Institución quitada de tus guardadas.' : 'Institución guardada.');
    }
}
