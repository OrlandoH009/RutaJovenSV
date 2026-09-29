<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $totalQuestions = Question::count();
        $answeredQuestions = $user->answers()->count();

        return view('dashboard', [
            'profile' => $user->interestProfile,
            'labels' => config('interests.labels'),
            'savedCareers' => $user->savedCareers()->with('career.academicArea')->latest()->take(5)->get(),
            'savedCareersCount' => $user->savedCareers()->count(),
            'savedInstitutionsCount' => $user->savedInstitutions()->count(),
            'route' => $user->academicRoute,
            'totalQuestions' => $totalQuestions,
            'answeredQuestions' => $answeredQuestions,
            'questionnaireComplete' => $totalQuestions > 0 && $answeredQuestions >= $totalQuestions,
        ]);
    }
}
