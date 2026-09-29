<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\InterestProfileService;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class InterestProfileController extends Controller
{
    public function show(Request $request, InterestProfileService $interestProfileService, RecommendationService $recommendations)
    {
        $profile = $request->user()->interestProfile;

        $relatedCareers = collect();
        $explanation = null;

        if ($profile) {
            $explanation = $interestProfileService->explanationFor($profile);
            $relatedCareers = $recommendations->relatedCareers($profile, limit: 6);
        }

        return view('interest-profile.show', [
            'profile' => $profile,
            'explanation' => $explanation,
            'relatedCareers' => $relatedCareers,
            'labels' => config('interests.labels'),
        ]);
    }
}
