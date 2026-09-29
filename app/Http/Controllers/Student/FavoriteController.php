<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Institution;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggleCareer(Request $request, Career $career)
    {
        $user = $request->user();
        $existing = $user->savedCareers()->where('career_id', $career->id)->first();

        if ($existing) {
            $existing->delete();
        } else {
            $user->savedCareers()->create(['career_id' => $career->id]);
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

        return back()->with('status', $existing ? 'Institución quitada de tus guardadas.' : 'Institución guardada.');
    }
}
