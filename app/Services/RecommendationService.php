<?php

namespace App\Services;

use App\Models\Career;
use App\Models\InterestProfile;
use Illuminate\Support\Collection;

class RecommendationService
{
    /**
     * Carreras cuyo perfil de intereses se parece más al del usuario.
     * Nunca se afirma que una carrera es "la correcta"; solo se muestra afinidad.
     */
    public function relatedCareers(InterestProfile $profile, int $limit = 6, ?int $excludeCareerId = null): Collection
    {
        $userScores = $profile->scores ?? [];

        return Career::with(['academicArea', 'interestWeights'])
            ->when($excludeCareerId, fn ($query) => $query->where('id', '!=', $excludeCareerId))
            ->get()
            ->map(function (Career $career) use ($userScores) {
                $career->affinity_score = $this->similarity($userScores, $career->interestWeights->pluck('weight', 'interest_key')->toArray());

                return $career;
            })
            ->filter(fn (Career $career) => $career->affinity_score > 0)
            ->sortByDesc('affinity_score')
            ->take($limit)
            ->values();
    }

    /**
     * Similitud simple: para cada eje, toma el mínimo entre el perfil del
     * usuario y la carrera (cuánto "coinciden"), normalizado a 0-100.
     */
    private function similarity(array $userScores, array $careerWeights): int
    {
        if (empty($careerWeights)) {
            return 0;
        }

        $matched = 0;
        $possible = 0;

        foreach ($careerWeights as $key => $weight) {
            $userScore = $userScores[$key] ?? 0;
            $matched += min($userScore, $weight);
            $possible += $weight;
        }

        return $possible > 0 ? (int) round($matched / $possible * 100) : 0;
    }
}
